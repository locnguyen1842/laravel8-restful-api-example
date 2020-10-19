<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\DTOs\Comment\CommentCollection;
use App\Http\DTOs\Comment\CommentPostResource;
use App\Http\DTOs\Comment\CommentUserResource;
use App\Http\DTOs\SimpleCollection;
use App\Models\Post;
use App\Models\User;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends BaseApiController
{

    private $commentService;

    public function __construct(CommentService $commentService) {
        $this->commentService = $commentService;
    }

    public function getPostComments(Post $post, Request $request)
    {
        $comments = $this->commentService->getCommentsByPost($post, $request);

        return $this->responseFromResource(new SimpleCollection($comments, CommentPostResource::class));
    }
    
    public function getUserComments(User $user, Request $request)
    {
        $comments = $this->commentService->getCommentsByUser($user, $request);

        return $this->responseFromResource(new SimpleCollection($comments, CommentUserResource::class));
    }
}
