<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $contactBody;
    public $name;
    public $email;
    public $phone;

    public function __construct($question)
    {
        $this->contactBody = $question['message'];
        $this->name = $question['name'];
        $this->email = $question['email'];
        $this->phone = $question['phone'] ?? null;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: [new \Illuminate\Mail\Mailables\Address($this->email, $this->name)],
            subject: 'Contact Message',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.ContactMailView',
            with: [
                'contactBody' => $this->contactBody,
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
