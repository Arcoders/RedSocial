<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VotePostController extends Controller
{

    public function upvote()
    {
        return [
            'new_score' => 1
        ];
    }

}
