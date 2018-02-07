<?php

namespace peczis\pecCms\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserCreated extends Mailable
{
    use Queueable, SerializesModels;

    private $login;

    private $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('pec-cms::emails.auth.user_created')->with([
            'login' => $this->login,
            'password' => $this->password
        ]);
    }
}
