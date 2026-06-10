<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Http\Resources\Api\PostResource;

class PostController extends ApiController
{
    public function __construct()
    {
        $this->model = Post::class;
        $this->resource = PostResource::class;
    }

    public function show($slug)
    {
        $post = Post::with($this->with)
            ->active()
            ->where('slug', $slug)
            ->firstOrFail();

        return new PostResource($post);
    }
}
