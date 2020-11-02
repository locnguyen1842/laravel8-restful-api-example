<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\DTOs\Comment\CommentPostResource;
use App\Http\DTOs\Comment\CommentUserResource;
use App\Http\DTOs\SimpleCollection;
use App\Http\Requests\Comment\CommentOnPostCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Models\Comment;
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

        return $this->response(new SimpleCollection($comments, CommentPostResource::class));
    }
    
    public function getUserComments(User $user, Request $request)
    {
        $comments = $this->commentService->getCommentsByUser($user, $request);

        return $this->response(new SimpleCollection($comments, CommentUserResource::class));
    }

    public function commentOnPost(Post $post, CommentOnPostCommentRequest $request)
    {
        $this->commentService->commentOnPost($post, $request);

        return $this->responseNoContent(self::HTTP_CREATED);
    }

    public function update(Comment $comment, UpdateCommentRequest $request)
    {
        $this->commentService->update($comment, $request);

        return $this->responseNoContent();
    }

    public function destroy(Comment $comment)
    {
        $this->commentService->destroy($comment);

        return $this->responseNoContent();
    }
}
