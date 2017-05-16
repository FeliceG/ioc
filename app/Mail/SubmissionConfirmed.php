<?php

namespace ioc\Mail;

use ioc\Research;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubmissionConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a research instance.
     *
     * @return void
     */

     public $research;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Research $research)
    {
        $this->research = $research;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(fgardner@partners.org)
                    ->view('email.submission');
    }
}
