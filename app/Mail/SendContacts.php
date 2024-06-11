<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendContacts extends Mailable
{
    use Queueable, SerializesModels;

    protected $form;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($form)
    {
        $this->form = $form;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from.address'))->subject('Contact form')->markdown('email.contactForm')->with('form', $this->form);;
    }
}
