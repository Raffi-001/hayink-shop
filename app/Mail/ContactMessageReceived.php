<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessageReceived extends Mailable
{
    use Queueable, SerializesModels;

    public string $name;
    public string $email;
    public string $messageContent;

    public function __construct(string $name, string $email, string $messageContent)
    {
        $this->name = $name;
        $this->email = $email;
        $this->messageContent = $messageContent;
    }

    public function build(): static
    {
        return $this
            ->from('noreply@hayink.com', 'HayInk')
            ->subject('New Contact Message from ' . $this->name)
            ->markdown('emails.contact.received')

            ->with([
                'name' => $this->name,
                'email' => $this->email,
                'messageContent' => $this->messageContent,
            ]);
    }
}
