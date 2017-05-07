<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use App\{Post, Category};
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PostsListTest extends DuskTestCase
{

    use DatabaseMigrations;

    function test_a_user_can_see_the_posts_list_and_go_to_the_details()
    {

        $post = $this->createPost([
            'title' => 'Esta es una pregunta' // 1-esta-es-una-pregunta
        ]);

        $this->browse(function($browser) use($post) {
            $browser->visit('/')
                    ->assertSeeIn('h1', 'Posts')
                    ->assertSee($post->title)
                    ->clickLink($post->title)
                    ->assertPathIs('/posts/1-esta-es-una-pregunta');
        });

    }

    function test_a_user_can_see_posts_filtered_by_category()
    {

        $laravel = factory(Category::class)->create([
            'name' => 'Laravel',
            'slug' => 'laravel'
        ]);

        $vue = factory(Category::class)->create([
            'name' => 'Vue.js',
            'slug' => 'vue-js'
        ]);

        $laravelPost = factory(Post::class)->create([
            'title' => 'Nuevo post de Laravel',
            'category_id' => $laravel->id
        ]);

        $vuePost = factory(Post::class)->create([
            'title' => 'Nuevo post de Vue.js',
            'category_id' => $vue->id
        ]);

        $this->browse(function($browser) use($laravelPost, $vuePost) {
            $browser->visit('/')
                    ->assertSee($laravelPost->title)
                    ->assertSee($vuePost->title)
                    ->clickLink('Laravel')
                    ->assertSeeIn('h1', 'Post de Laravel')
                    ->assertSee($laravelPost->title)
                    ->assertDontSee($vuePost->title);
        });

    }

}
