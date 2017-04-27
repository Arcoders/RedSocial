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
            'title' => 'Este es el titulo del post',
            'content' => 'Este es el contenido del post'
        ]);

        $user->posts()->save($post);

        // when

        $this->visit($post->url)
             ->seeInElement('h1', $post->title)
             ->see($post->content)
             ->see($user->name);

    }

    function test_old_urls_are_redirected()
    {

        // having

        $user = $this->defaultUser();

        $post = factory(\App\Post::class)->make([
            'title' => 'Old title'
        ]);

        $user->posts()->save($post);

        $url = $post->url;

        $post->update(['title' => 'New title']);

        $this->visit($url)->seePageIs($post->url);

    }


}
