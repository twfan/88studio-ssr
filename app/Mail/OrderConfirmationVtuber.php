<?php

namespace App\Mail;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationVtuber extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(protected Transaction $transaction, protected Product $product)
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
            subject: 'Order Confirmation - 88 Studio'
        );
    }

    /**
     * Get the message content definition.
     */ 
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.vtuber.confirmation',
            with: [
                'product' => $this->product,
                'transaction' => $this->transaction,
                'url' => env('APP_URL') . '/member/vtuber/'.$this->product->id.'/adopt/'
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
