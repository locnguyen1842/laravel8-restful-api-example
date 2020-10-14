<?php

namespace App\Http\Controllers\Api;

use App\DTOs\Post\PostCollection;
use App\DTOs\Post\PostResource;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends BaseApiController
{

    private $postService;

    public function __construct(PostService $postService) {
        $this->postService = $postService;
    }

    public function index(Request $request)
    {
        $posts = $this->postService->all($request);

        return response(new PostCollection($posts));
    }

    public function store(StorePostRequest $request)
    {
        $post = $this->postService->store($request);

        return $this->responseNoContent(self::HTTP_CREATED);
    }

    public function show(Post $post)
    {
        $post = $this->postService->show($post);

        return response(new PostResource($post));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $post = $this->postService->update($request, $post);

        return $this->responseNoContent();
    }

    public function destroy(Post $post)
    {
        $post = $this->postService->delete($post);

        return $this->responseNoContent(self::HTTP_OK);
    }
}
