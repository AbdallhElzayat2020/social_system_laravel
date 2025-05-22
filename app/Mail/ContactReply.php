<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactReply extends Mailable
{
    use Queueable, SerializesModels;

    public $recipientName;
    public $subject;
    public $replyMessage;

    /**
     * Create a new message instance.
     */
    public function __construct($recipientName, $subject, $replyMessage)
    {
        $this->recipientName = $recipientName;
        $this->subject = $subject;
        $this->replyMessage = $replyMessage;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject($this->subject)
                    ->view('emails.contact-reply')
                    ->with([
                        'recipientName' => $this->recipientName,
                        'replyMessage' => $this->replyMessage
                    ]);
    }
} 