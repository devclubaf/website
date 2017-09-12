<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\User;
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

    public function locations()
    {
        $users = User::all();
        return response()->json($users);
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
    public function update(Request $request)
    {
        $user = User::where('remember_token', $request->input('token'))->first();
        $user->gender = $request->input('gender');
        $user->dob = $request->input('dob');
        $user->location = $request->input('location');
        $user->save();
        return redirect('/');
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
        $data = Socialite::driver('github')->user();
        $user = User::where('email', '=', $data->user['email']);
        if (!$user->first())
        {
            $user = new User;
            $user->name = $data->user['name'];
            $user->nickname = $data->nickname;
            $user->email = $data->user['email'];
            $user->avatar = $data->user['avatar_url'];
            $user->html_url = $data->user['html_url'];
            $user->type = $data->user['type'];
            $user->company = $data->user['company'];
            $user->public_repos = $data->user['public_repos'];
            $user->remember_token = $data->token;
            $user->save();
        }
        return redirect("register/form/$user->remember_token");
    }
}
