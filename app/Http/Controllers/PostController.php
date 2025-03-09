<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('user_id', auth()->id())->latest()->get();

        $this->addIsLikedParam($posts);
        return PostResource::collection($posts);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();
            $imageId = $data['image_id'];
            unset($data['image_id']);

            $data['user_id'] = auth()->id();
            $post = Post::create($data);

            $this->processImage($imageId, $post);

            PostImage::clearStorage();

            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            return response()->json(['error' => $exception->getMessage()]);
        }

        return new PostResource($post);
    }

    private function processImage($imageId, $post){
        if(isset($imageId)){
            $image = PostImage::find($imageId);
            $image->update([
                'post_id' => $post->id
            ]);
        }
    }

    public function toggleLike(Post $post)
    {
        $res = auth()->user()->likedPost()->toggle($post->id);
        $data['is_liked'] = count($res['attached']) > 0;
        $data['likes_count'] = $post->likedUsers()->count();
        return $data;
    }
}
