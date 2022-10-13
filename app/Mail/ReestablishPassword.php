<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReestablishPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(protected string $url)
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): ReestablishPassword
    {
        return $this->view('emails.reestablish')->with([
            'url' => $this->url
        ]);
    }
}
