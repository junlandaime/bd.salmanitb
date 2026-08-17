<?php

namespace App\Mail;

use App\Models\SpnRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SpnRegistrationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public SpnRegistration $registration;
    public ?string $activationToken;
    public bool $hasExistingAccount;

    /**
     * Create a new message instance.
     */
    public function __construct(SpnRegistration $registration, ?string $activationToken = null, bool $hasExistingAccount = false)
    {
        $this->registration = $registration;
        $this->activationToken = $activationToken;
        $this->hasExistingAccount = $hasExistingAccount;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $batchKe = $this->registration->activityBatch->batch_ke ?? 'XX';
        return new Envelope(
            subject: 'Konfirmasi Pendaftaran SPN Batch ' . $batchKe . ' - Bidang Dakwah Salman ITB',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.spn-registration-confirmation',
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
