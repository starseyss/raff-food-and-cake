<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RefundRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public $order,
        public $notification
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🪙 New Refund Request - ' . $this->order->midtrans_order_id,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.refund-request',
            with: ['refundData' => $this->notification->refund_data ?? []]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
public function attachments(): array
{
    $attachments = [];

    // decode jika masih string JSON
    $refundData = $this->notification->refund_data;

    if (is_string($refundData)) {
        $refundData = json_decode($refundData, true);
    }

    // cek path
    if (
        is_array($refundData) &&
        isset($refundData['proof_path'])
    ) {

        $filePath = storage_path('app/' . $refundData['proof_path']);

        // cek file exists
        if (file_exists($filePath)) {

            $attachments[] = Attachment::fromPath($filePath)
                ->as('bukti_transfer.' . pathinfo($filePath, PATHINFO_EXTENSION));

        } else {

            \Log::error('REFUND ATTACHMENT FILE NOT FOUND', [
                'path' => $filePath
            ]);

        }
    }

    return $attachments;
}
}
