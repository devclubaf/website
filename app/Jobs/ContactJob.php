<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Requests\ContactFormRequest;
use App\Contact;

class ContactJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $comment;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $email, string $comment)
    {
        $this->email = $email;
        $this->comment = $comment;
    }


    public static function fromRequest(ContactFormRequest $request): self
    {
        return new static(
            $request->email(),
            $request->comment()
        );
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $contact = new Contact([
            'email' => $this->email,
            'comment' => $this->comment,
        ]);

        $contact->save();

        return $contact;
    }
}
