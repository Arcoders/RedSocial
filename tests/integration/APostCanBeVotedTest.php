<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Vote;

class APostCanBeVotedTest extends TestCase
{

    use DatabaseTransactions;

    function test_a_post_can_be_upvoted()
    {
        $this->actingAs($user = $this->defaultUser());

        $post = $this->createPost();

        Vote::upvote($post);

        $this->assertDatabaseHas('votes', [
            'post_id' => $post->id,
            'user_id' => $user->id,
            'vote' => 1
        ]);

        $this->assertSame(1, $post->score);
    }

    function test_a_post_can_be_downvoted()
    {
        $this->actingAs($user = $this->defaultUser());

        $post = $this->createPost();

        Vote::downvote($post);

        $this->assertDatabaseHas('votes', [
            'post_id' => $post->id,
            'user_id' => $user->id,
            'vote' => -1
        ]);

        $this->assertSame(-1, $post->score);
    }

    function test_a_post_cannot_be_upvoted_twice_by_the_same_user()
    {
        $this->actingAs($user = $this->defaultUser());

        $post = $this->createPost();

        Vote::upvote($post);
        Vote::upvote($post);

        $this->assertSame(1, Vote::count());

        $this->assertSame(1, $post->score);
    }

    function test_a_post_cannot_be_downvoted_twice_by_the_same_user()
    {
        $this->actingAs($user = $this->defaultUser());

        $post = $this->createPost();

        Vote::downvote($post);
        Vote::downvote($post);

        $this->assertSame(1, Vote::count());

        $this->assertSame(-1, $post->score);
    }

    function test_a_user_can_switch_from_upvote_to_downvote()
    {
        $this->actingAs($user = $this->defaultUser());

        $post = $this->createPost();

        Vote::upvote($post);

        Vote::downvote($post);

        $this->assertSame(1, Vote::count());

        $this->assertSame(-1, $post->score);
    }

    function test_a_user_can_switch_from_downvote_to_upvote()
    {
        $this->actingAs($user = $this->defaultUser());

        $post = $this->createPost();

        Vote::downvote($post);

        Vote::upvote($post);

        $this->assertSame(1, Vote::count());

        $this->assertSame(1, $post->score);
    }

}
