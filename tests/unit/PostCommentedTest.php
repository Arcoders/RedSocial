<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Notifications\PostCommented;
use App\Comment;
use App\User;
use App\Post;
use Illuminate\Notifications\Messages\MailMessage;

class PostCommentedTest extends TestCase
{

    use DatabaseTransactions;

    public function test_it_build_a_mail_message()
    {

        $post = factory(Post::class)->create([
            'title' => 'Nombre del post'
        ]);

        $author = factory(App\User::class)->create([
            'name' => 'Ismael Haytam'
        ]);

        $comment = factory(Comment::class)->create([
            'post_id' => $post->id,
            'user_id' => $author->id
        ]);

        $notification = new PostCommented($comment);

        $subscriber = factory(User::class)->create();

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
