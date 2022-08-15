<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApproverReminderEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $setting;
    public $suppliers;

    /**
     * Create a new message instance.
     *
     * @param $setting
     * @param $user
     * @param $token
     */
    public function __construct($user,$setting, $suppliers)
    {
        $this->user = $user;
        $this->setting = $setting;
        $this->suppliers = $suppliers;
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
        return $this->view('mail.approver.approver-reminder-email')
            ->text('mail.approver.approver-reminder-email_plain')
            ->subject('Approver Reminder');
    }
}
