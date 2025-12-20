<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class OtpMail extends Mailable
{
    public function __construct(public string $code)
    {
    }

    public function build()
    {
        return $this
            ->subject('Your One-Time Password')
            ->view('emails.otp')
            ->with([
                'code' => $this->code,
            ]);
    }
}

