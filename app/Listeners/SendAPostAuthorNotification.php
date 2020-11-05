<?php

namespace App\Listeners;

use App\Notifications\SendMailToPostAuthorHasANewComment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendAPostAuthorNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $comment = $event->comment;

        $author = $comment->post->user;
      
        try {
            $author->notify(new SendMailToPostAuthorHasANewComment($comment));
        } catch (\Throwable $th) {
            // then skip
        }
    }
}
