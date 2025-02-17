<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegisteredMail extends Mailable
{
    use SerializesModels;

    public $username;
    public $password;

    /**
     * Create a new message instance.
     *
     * @param string $username
     * @param string $password
     * @return void
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Tu cuenta ha sido registrada')
                    ->view('emails.user_registered')
                    ->with([
                        'username' => $this->username,
                        'password' => $this->password,
                    ])
                    ->attach(public_path('assets/images/logoSe.png'), [
                        'as' => 'logoSe.png',
                        'mime' => 'image/png',
                    ])
                    ->embed(public_path('assets/images/logoSe.png')); // Incrustar la imagen
    }
}
