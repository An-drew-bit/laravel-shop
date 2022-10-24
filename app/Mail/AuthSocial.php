<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AuthSocial extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(protected string $password)
    {
    }

    public function build(): AuthSocial
    {
        return $this->view('emails.auth-social')->with([
            'password' => $this->password
        ]);
    }
}
