<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CredentialMail extends Mailable
{
    use Queueable, SerializesModels;
    public $username,$password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($array)
    {
        $this->username=$array['username'];
        $this->password=$array['password'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('eYTCP Login Credentials')
        ->view('emails.auth.create_acc_content');
        // ->attach('var/www/eapp/downloads/eFSI_Letter_of_Intent.pdf', [
        //                 'as' => 'eFSI_Letter_of_Intent.pdf',
        //                 'mime' => 'application/pdf',
        //             ]);
    }
}
