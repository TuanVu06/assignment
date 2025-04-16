<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FeedbackMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            // subject: 'Feedback Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            // view: 'view.name',
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

    public function build()
    {
        $subject = match ($this->data['type']) {
            'gopy' => 'Góp ý từ người dùng',
            'phanhoi' => 'Phản hồi từ người dùng',
            'hoptac' => 'Yêu cầu hợp tác',
            default => 'Thông tin từ người dùng',
        };

        $mail = $this->subject($subject)
                     ->view('email.feedback')
                     ->with(['data' => $this->data]);

        // Đính kèm file nếu có
        if (isset($this->data['attachment'])) {
            $mail->attach($this->data['attachment']['path'], [
                'as' => $this->data['attachment']['name'],
            ]);
        }

        return $mail;
    }
}
