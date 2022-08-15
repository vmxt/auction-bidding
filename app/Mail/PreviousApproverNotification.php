<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PreviousApproverNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $setting;
    public $current;
    public $supplier;

    /**
     * Create a new message instance.
     *
     * @param $setting
     * @param $user
     * @param $token
     */
    public function __construct($user,$setting,$current,$supplier)
    {
        $this->user = $user;
        $this->setting = $setting;
        $this->current = $current;
        $this->supplier = $supplier;
        if($this->user->firstname != '') {
            $this->user->username = $this->user->firstname;
        } else {
            $exploded_username = explode("@", $this->user->username);
            $this->user->username = $exploded_username[0];
        }
        if($this->current->firstname != '') {
            $this->current->username = $this->current->firstname;
        } else {
            $exploded_username1 = explode("@", $this->current->username);
            $this->current->username = $exploded_username1[0];
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.approver.previous-approver')
            ->text('mail.approver.previous-approver_plain')
            ->subject('Supplier Application Notification');
    }
}
