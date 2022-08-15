<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdatePasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $setting;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($setting, $user)
    {
        $this->setting = $setting;
        $this->user = $user;

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
        return $this->view('mail.password-success')
                    ->text('mail.password-success_plain')
                    ->subject('Password Reset Successful');
    }
}
