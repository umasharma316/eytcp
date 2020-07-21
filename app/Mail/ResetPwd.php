<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPwd extends Mailable
{
    use Queueable, SerializesModels;
    public $username, $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username, $token)
    {
        //
        $this->username=$username;
        $this->token=$token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.auth.forgotpassword')
                    ->subject('IIT Bombay, e-Yantra - eYTCP Login : Forgot password');
    }
}
