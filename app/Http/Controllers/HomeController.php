<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Socialite;
use App\User;
use App\Contact;
use App\Feedback;
use JsValidator;
use App\Jobs\ContactJob;
use App\Jobs\FeedbackJob;
use App\Jobs\RegisterUserJob;
use App\Jobs\UpdateUserJob;
use App\Http\Requests\RegisterFormRequest;
use App\Http\Requests\ContactFormRequest;
use App\Http\Requests\FeedbackFormRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\UserResource;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * @return mixed
     */
    public function users(User $user)
    {
        return UserResource::collection($user->inRandomOrder()->get());
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $socialiteUser = Socialite::driver('github')->user();

        try {
            $user = User::findByGithubId($socialiteUser->id);

            return $this->userFound($user);

        } catch (ModelNotFoundException $exception) {

            return $this->userNotFound($socialiteUser);
        }
    }

    private function userFound(User $user)
    {
        $token = $user->remember_token;

        $status = 'You already registered! <a href="/register/form/'.$token.'">Do you want to update your information</a>';

        return redirect()->route('home')->with('status', $status);
    }

    private function userNotFound($socialiteUser)
    {
        $this->dispatchNow(RegisterUserJob::fromRequest($socialiteUser));

        return redirect()->route('form', ['token' => $socialiteUser->token]);
    }

    /**
     * @param $token
     * @return mixed
     */
    public function register($token)
    {
        return view('register', compact('token'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function update(RegisterFormRequest $request,  $token)
    {
        $user = User::where('remember_token', $token)->firstOrFail();

        $dob = $user->dob;

        $updated_user = $this->dispatchNow(UpdateUserJob::fromRequest($user, $request));

        $status = User::checkDateOfBrith($dob);

        return redirect()->route('home')->with('status', $status);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function contact(ContactFormRequest $request)
    {
        $contact = $this->dispatchNow(ContactJob::fromRequest($request));

        return redirect()->route('home')->with('status', 'Thank you for contacting with Us!');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function feedback(FeedbackFormRequest $request)
    {
        $feedback = $this->dispatchNow(FeedbackJob::fromRequest($request));

        return redirect()->route('home')->with('status', 'Thank you for giving Feedback!');
    }

}
