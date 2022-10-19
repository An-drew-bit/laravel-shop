<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReestablishPassword extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(protected string $url)
    {
    }

    public function build(): ReestablishPassword
    {
        return $this->view('emails.reestablish')->with([
            'url' => $this->url
        ]);
    }
}
