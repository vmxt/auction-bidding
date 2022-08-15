<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $setting;
    public $user;
    public $token;

    /**
     * Create a new message instance.
     *
     * @param $setting
     * @param $user
     * @param $token
     */
    public function __construct($setting, $user, $token)
    {
        $this->setting = $setting;
        $this->user = $user;
        $this->token = $token;

        if($this->user->firstname != '') {
            $this->user->username = $this->user->firstname;
        } else {
            $exploded_username = explode("@", $this->user->username);
            $this->user->username = $exploded_username[0];
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.reset-password')
            ->text('mail.reset-password_plain')
            ->subject('Reset Password Notification');
    }
}
