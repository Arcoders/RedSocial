<?php

use App\Notifications\PostCommented;
use App\Comment;
use App\User;
use App\Post;
use Illuminate\Notifications\Messages\MailMessage;

class PostCommentedTest extends TestCase
{

    public function test_it_build_a_mail_message()
    {

        $post = new Post([
            'title' => 'Nombre del post'
        ]);

        $author = new User([
            'name' => 'Ismael Haytam'
        ]);

        $comment = new Comment;
        $comment->post = $post;
        $comment->user = $author;

        $notification = new PostCommented($comment);

        $subscriber = new User();

        $message = $notification->toMail($subscriber);

        $this->assertInstanceOf(MailMessage::class, $message);

        $this->assertSame(
            'Nuevo comentario en: Nombre del post',
            $message->subject
        );

        $this->assertSame(
            'Ismael Haytam escribió un comentario en: Nombre del post',
            $message->introLines[0]
        );

        $this->assertSame($comment->post->url, $message->actionUrl);

    }

}
