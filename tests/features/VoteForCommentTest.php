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
    
}
