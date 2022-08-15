<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RejectedSupplierNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $supplier;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($supplier)
    {
        $this->supplier = $supplier;
        if( array_key_exists('first_name', $this->supplier) && $this->supplier->first_name != '') {
            $this->supplier->username = $this->supplier->first_name;
        } else {
            $exploded_username = explode("@", $this->supplier->email);
            $this->supplier->username = $exploded_username[0];
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.supplier.applicant.rejected')     
            ->text('mail.supplier.applicant.rejected_plain')      
            ->subject('Supplier Application Rejected');
    }
}
