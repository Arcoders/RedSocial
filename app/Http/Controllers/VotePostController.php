<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
USE App\{Post, VoteRepository};

class VotePostController extends Controller
{

    /**
    * @var voteRespository
    */
    private $voteRespository;

    public function __construct(VoteRespository $voteRespository)
    {
        $this->voteRespository = $voteRespository;
    }

    public function upvote(Post $post)
    {
        $this->voteRespository->upvote($post);

        return [
            'new_score' => $post->score
        ];
    }

    public function downvote(Post $post)
    {
        $this->voteRespository->downvote($post);

        return [
            'new_score' => $post->score
        ];
    }

    public function undoVote(Post $post)
    {
        $this->voteRespository->undoVote($post);

        return [
            'new_score' => $post->score
        ];
    }

}
