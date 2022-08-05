<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    private $_subject;
    private $_data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $data)
    {
        $this->_subject = $subject;
        $this->_data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->_subject)
            ->markdown('mail.receipt')
            ->from((auth()->user()->sucursal->email) ?? 'noresponder@hornero.com')
            ->with([
                'title' => $this->_subject,
                'data' => $this->_data
            ]);
    }
}
