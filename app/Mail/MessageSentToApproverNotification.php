<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessageSentToApproverNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $setting;
    public $supplier;

    /**
     * Create a new message instance.
     *
     * @param $setting
     * @param $user
     * @param $token
     */
    public function __construct($user,$setting,$supplier)
    {
        $this->user = $user;
        $this->setting = $setting;
        $this->supplier = $supplier;
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
        return $this->view('mail.approver.message-sent-notification')
            ->text('mail.approver.message-sent-notification_plain')
            ->subject('Supplier Application Notification');
    }
}
