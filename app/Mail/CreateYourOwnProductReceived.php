<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreateYourOwnProductReceived extends Mailable
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
            ->subject('New Custom Product Submission: ' . ($this->data['name'] ?? 'Unknown User'))
            ->view('emails.product.received')
            ->with(['data' => $this->data]);
    }
}
