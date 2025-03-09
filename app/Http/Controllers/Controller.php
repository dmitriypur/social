<?php

namespace App\Http\Controllers;

use App\Models\LikedPost;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function addIsLikedParam($posts)
    {
        $likesIds = LikedPost::where('user_id', auth()->id())->get('post_id')->pluck('post_id')->toArray();
        foreach ($posts as $post){
            if(in_array($post->id, $likesIds)){
                $post->is_liked = true;
            }
        }
    }
}
