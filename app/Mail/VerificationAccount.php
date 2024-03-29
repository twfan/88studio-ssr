<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;

class VerificationAccount extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        protected User $user,
    )
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('support@88studio.id', 'Support 88studio'),
            subject: 'Verification Account - 88studio',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $encryptedId = Crypt::encryptString($this->user->id);
        return new Content(
            markdown: 'mail.account.verification',
            with: [
                'user' => $this->user,
                'url' => env('APP_URL') . '/verify/' . $encryptedId
            ]
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
