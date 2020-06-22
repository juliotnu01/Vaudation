<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitationsVaudition extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $invitation;
    protected $data;
    public function __construct($invitation, $data)
    {
        $this->invitation = $invitation;
        $this->data = $data;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $invitation = $this->invitation;
        $data = $this->data;
        return $this->view('Mails.invitations', compact(["invitation", "data"]));
    }
}
