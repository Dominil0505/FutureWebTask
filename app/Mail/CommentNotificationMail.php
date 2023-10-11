<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CommentNotificationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $emailContent;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailContent)
    {
        $this->emailContent = $emailContent;
    }

    public function build()
    {
        $comment = $this->emailContent['comment'];
        $postTitle = $comment->post->title;

        return $this->to($comment->post->user->email)
            ->subject('Komment érkezett')
            ->view('commentsPage.commentNotification')
            ->with([
                'comment' => $comment,
                'postTitle' => $postTitle,
            ]);
    }



    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Komment érkezett',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'commentsPage.commentNotification',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
