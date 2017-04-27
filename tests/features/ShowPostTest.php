<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShowPostTest extends TestCase
{

    function test_a_user_can_see_the_post_details()
    {

        // having

        $user = $this->defaultUser([
            'name' => 'Ismael Haytam'
        ]);

        $post = factory(\App\Post::class)->make([
            'title' => 'Como instalar Laravel',
            'title' => 'Esste el el contenido del post'
        ]);

        $user->posts()->save($post);

        // when

        $this->visit(route('posts.show', $post))
             ->seeInElement('h1', $post->title)
             ->see($post->content)
             ->see($user->name);

    }

}
