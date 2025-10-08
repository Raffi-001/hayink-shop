<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplyAsArtistReceived extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;

    /**
     * Create a new message instance.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     */
    public function build(): static
    {
        return $this->from('noreply@hayink.com', 'HayInk')
            ->subject('New Artist Application: ' . ($this->data['name'] ?? 'Unknown Artist'))
            ->view('emails.artist.received')
            ->with(['data' => $this->data]);
    }
}
