<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SupplierApplicantApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $supplier;
    public $pass;
    public $is_classic;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($supplier,$pass, $is_classic = false)
    {
        $this->supplier = $supplier;
        $this->pass = $pass;
        $this->is_classic = $is_classic;

        if($this->supplier->first_name != '') {
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
        if( !$this->is_classic ) {
            return $this->view('mail.supplier.applicant.approval')           
                ->subject('Supplier Application Accepted');
        } else {
            return $this->view('mail.supplier.applicant.approval-classic')           
                ->subject('Supplier Application Accepted');
        }
    }
}
