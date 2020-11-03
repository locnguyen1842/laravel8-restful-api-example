<?php

namespace App\Http\Controllers\Api;

use App\Http\DTOs\Post\PostCollection;
use App\Http\DTOs\Post\PostResource;
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
        $this->authorize('viewAny', Post::class);

        $posts = $this->postService->all($request);

        return $this->response(new PostCollection($posts));
    }

    public function store(StorePostRequest $request)
    {
        $this->authorize('create', Post::class);

        $this->postService->store($request);

        return $this->responseNoContent(self::HTTP_CREATED);
    }

    public function show(Post $post)
    {
        $this->authorize('view', Post::class);

        $post = $this->postService->show($post);

        return $this->response(new PostResource($post));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $this->postService->update($request, $post);

        return $this->responseNoContent();
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $this->postService->delete($post);

        return $this->responseNoContent(self::HTTP_OK);
    }
}
