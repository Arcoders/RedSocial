<?php
use App\Comment;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class VoteForCommentTest extends TestCase
{
    use DatabaseTransactions;
    protected $comment;
    protected $user;
    public function setUp()
    {
        parent::setUp();
        $this->actingAs($this->user = $this->defaultUser());
        $this->comment = factory(Comment::class)->create();
    }
    function test_a_user_can_upvote_for_a_comment()
    {
        $this->postJson("comments/{$this->comment->id}/vote/1")
            ->assertSuccessful()
            ->assertJson([
                'new_score' => 1
            ]);
        $this->comment->refresh();
        $this->assertSame(1, $this->comment->current_vote);
        $this->assertSame(1, $this->comment->score);
    }
    function test_a_user_can_downvote_for_a_comment()
    {
        $this->postJson("comments/{$this->comment->id}/vote/-1")
            ->assertSuccessful()
            ->assertJson([
                'new_score' => -1
            ]);
        $this->comment->refresh();
        $this->assertSame(-1, $this->comment->current_vote);
        $this->assertSame(-1, $this->comment->score);
    }

}
