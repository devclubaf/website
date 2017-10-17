<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Requests\RegisterFormRequest;
use App\User;

class UpdateUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var \App\User
     */
    private $user;

    /**
     * @var array
     */
    private $attributes;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, array $attributes = [])
    {
        $this->user = $user;
        $this->attributes = array_only($attributes, ['gender', 'dob', 'location']);
    }

    public static function fromRequest(User $user, RegisterFormRequest $request): self
    {
        return new static($user, [
            'gender' => $request->gender(),
            'dob' => $request->dob(),
            'location' => $request->location(),
        ]);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): User
    {
        $this->user->update($this->attributes);

        return $this->user;
    }
}
