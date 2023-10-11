<?php

namespace App\Jobs;

use App\Mail\CommentNotificationMail;
use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendCommentNotification
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $comment;
    protected $post_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($comment, $post_id)
    {
        $this->comment = $comment;
        $this->post_id = $post_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $postOwner = $this->getPostOwner($this->post_id);

        $emailContent = [
            'comment' => $this->comment,
        ];

        Mail::to($postOwner->email)->send(new CommentNotificationMail($emailContent));
    }


    private function getPostOwner($post_id)
    {
        return Post::find($post_id);
    }
}
