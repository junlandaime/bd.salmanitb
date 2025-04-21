<?php

namespace App\Notifications;

use App\Models\TaarufQuestion;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class TaarufQuestionAnswered extends Notification
{
    use Queueable;

    protected $question;

    /**
     * Create a new notification instance.
     *
     * @param  TaarufQuestion  $question
     * @return void
     */
    public function __construct(TaarufQuestion $question)
    {
        $this->question = $question;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        Log::info('Sending taaruf question answered notification to: ' . $notifiable->email);

        // Coba kirim email menggunakan metode langsung jika notifikasi gagal
        if (!$this->sendEmailDirectly($notifiable)) {
            Log::error('Failed to send direct email, trying notification system');
        }

        // Perbaikan: periksa apakah profile dan user ada sebelum mencoba mengakses properti
        $profileOwnerName = 'Pengguna'; // Default value
        if (
            $this->question->profile &&
            $this->question->profile->user &&
            isset($this->question->profile->user->name)
        ) {
            $profileOwnerName = $this->question->profile->user->name;
        }

        return (new MailMessage)
            ->subject('Pertanyaan Ta\'aruf Anda Telah Dijawab')
            ->greeting('Assalamu\'alaikum ' . $notifiable->name)
            ->line('Pertanyaan ta\'aruf yang Anda ajukan telah dijawab.')
            ->line('Silakan login ke akun Anda untuk melihat jawaban tersebut.')
            ->action('Lihat Jawaban', URL::route('taaruf.questions.index'))
            ->line('Terima kasih telah menggunakan fitur Ta\'aruf Bidang Dakwah Masjid Salman ITB.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'question_id' => $this->question->id,
            'profile_id' => $this->question->profile_id,
            'message' => 'Pertanyaan ta\'aruf Anda telah dijawab',
            'created_at' => $this->question->updated_at->toDateTimeString(),
        ];
    }

    /**
     * Send email directly as fallback method
     *
     * @param  mixed  $notifiable
     * @return bool
     */
    protected function sendEmailDirectly($notifiable)
    {
        try {
            Mail::send('emails.taaruf-question-answered', [
                'question' => $this->question,
                'notifiable' => $notifiable,
                'url' => URL::route('taaruf.questions.index')
            ], function ($message) use ($notifiable) {
                $message->to($notifiable->email);
                $message->subject('Pertanyaan Ta\'aruf Anda Telah Dijawab');
            });

            Log::info('Email sent directly to: ' . $notifiable->email);
            return true;
        } catch (\Exception $e) {
            Log::error('Direct email sending error: ' . $e->getMessage());
            return false;
        }
    }
}
