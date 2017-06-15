<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
USE App\{Post, Vote};

class VotePostController extends Controller
{

    public function upvote(Post $post)
    {
        $score = Vote::upvote($post);

        return [
            'new_score' => $post->score
        ];
    }

    public function downvote(Post $post)
    {
        $score = Vote::downvote($post);

        return [
            'new_score' => $post->score
        ];
    }

}
