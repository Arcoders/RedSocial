<?php

use App\{Post, Category};

class createPostsTest extends FeatureTestCase
{

    public function test_a_user_create_a_post()
    {

        // having

        $title = 'Esta es una pregunta';
        $content = 'Este es el contenido';

        $this->actingAs($user = $this->defaultUser());

        $category = factory(Category::class)->create();

        // when

        $this->visit(route('posts.create'))
             ->type($title, 'title')
             ->type($content, 'content')
             ->select($category->id, 'category_id')
             ->press('Publicar');

        // Then

        $this->seeInDatabase('posts', [
            'title' => $title,
            'content' => $content,
            'pending' => true,
            'user_id' => $user->id,
            'slug' => 'esta-es-una-pregunta',
            'category_id' => $category->id
        ]);

        $post = Post::first();

        // Test the author is subscribed automatically to the post.

        $this->seeInDatabase('subscriptions', [
            'user_id' => $user->id,
            'post_id' => $post->id
        ]);

        // Test a user is redirected to the posts details after creating it

        $this->seePageIs($post->url);

    }


    public function test_creating_a_post_requires_authentication()
    {

        $this->visit(route('posts.create'))
             ->seePageIs(route('token'));

    }

    function test_create_post_form_validation()
    {
        $this->actingAs($this->defaultUser())
             ->visit(route('posts.create'))
             ->press('Publicar')
             ->seePageIs(route('posts.create'))
             ->seeInElement('#field_title.has-error .help-block', 'El campo título es obligatorio')
             ->seeInElement('#field_content.has-error .help-block', 'El campo contenido es obligatorio');
    }


}
