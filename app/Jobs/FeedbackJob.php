<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Requests\FeedbackFormRequest;
use App\Feedback;

class FeedbackJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $email, string $message)
    {
        $this->email = $email;
        $this->message = $message;
    }


    public static function fromRequest(FeedbackFormRequest $request): self
    {
        return new static(
            $request->email(),
            $request->message()
        );
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $feedback = new Feedback([
            'email' => $this->email,
            'message' => $this->message,
        ]);

        $feedback->save();

        return $feedback;
    }
}
