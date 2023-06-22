<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\EmailHelper;

class SFMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $name, $email, $mailbody)
    {

        $this->name = $name;
        $this->email = $email;
        $this->mailbody = $mailbody;
        $this->subject = $subject;


    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $body = "";
        $body .= EmailHelper::getEmailHeader();
        $body .= $this->mailbody;
        $body .= EmailHelper::getEmailFooter();
        $email_message = $this->from($this->email, $this->name)
            ->subject($this->subject)->view('emails.index')
            ->with(
                [
                    'html' => $body,
                ]
            );
        return $email_message;
    }
}
