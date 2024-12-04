<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class ParticipationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $participant;

    /**
     * Create a new message instance.
     *
     * @param array $participant
     */
    public function __construct($participant)
    {
        $this->participant = $participant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Confirmation : équipe Crédit Agricole')
                    ->view('emails.participation_confirmation');
    }
}
