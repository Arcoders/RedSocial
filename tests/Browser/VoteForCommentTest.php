<?php
namespace Tests\Browser;
use App\Comment;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class VoteForCommentTest extends DuskTestCase
{
    use DatabaseMigrations;

}
