<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\User;

class RegisterUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    private $github_id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $nickname;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $avatar;

    /**
     * @var string
     */
    private $html_url;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $company;

    /**
     * @var string
     */
    private $public_repos;

    /**
     * @var string
     */
    private $remember_token;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($github_id, $name, $nickname, $email, $avatar, $html_url, $type, $company, $public_repos, $remember_token)
    {
        $this->github_id = $github_id;
        $this->name = $name;
        $this->nickname = $nickname;
        $this->email = $email;
        $this->avatar = $avatar;
        $this->html_url = $html_url;
        $this->type = $type;
        $this->company = $company;
        $this->public_repos = $public_repos;
        $this->remember_token = $remember_token;
    }

    public static function fromRequest($socialiteUser): self
    {
        return new static(
            $socialiteUser->id,
            $socialiteUser->user['name'],
            $socialiteUser->nickname,
            $socialiteUser->user['email'],
            $socialiteUser->avatar,
            $socialiteUser->user['html_url'],
            $socialiteUser->user['type'],
            $socialiteUser->user['company'],
            $socialiteUser->user['public_repos'],
            $socialiteUser->token
        );
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): User
    {
        $user = new User([
            'github_id' => $this->github_id,
            'name' => $this->name,
            'nickname' => $this->nickname,
            'email' => $this->email,
            'avatar' => $this->avatar,
            'html_url' => $this->html_url,
            'type' => $this->type,
            'company' => $this->company,
            'public_repos' => $this->public_repos,
            'remember_token' => $this->remember_token,
        ]);

        $user->save();

        return $user;
    }
}
