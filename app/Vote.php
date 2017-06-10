<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{

    protected $guarded = [];

    public static function upvote(Post $post)
    {
        if(static::where([
            'post_id' => $post->id,
            'user_id' => auth()->id()
        ])->exists()) {
            return;
        }

        static::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'vote' => 1
        ]);

        $post->score = 1;
        $post->save();
    }

    public static function downvote(Post $post)
    {

        if(static::where([
            'post_id' => $post->id,
            'user_id' => auth()->id()
        ])->exists()) {
            return;
        }

        static::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'vote' => -1
        ]);

        $post->score = -1;
        $post->save();
    }

}
