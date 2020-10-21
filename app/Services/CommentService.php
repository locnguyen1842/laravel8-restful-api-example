<?php

namespace App\Services;

use App\ModelFilters\CommentFilter;
use App\Models\Post;
use App\Models\User;
use App\Repositories\Contracts\CommentRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CommentService {

    private $commentRepo;

    public function __construct(CommentRepositoryInterface $commentRepo)
    {
        $this->commentRepo = $commentRepo;
    }

    public function getCommentsByPost(Post $post,Request $request)
    {
        return $post->comments()
            ->modelFilter(CommentFilter::class, $request->all())
            ->paginate($request->size);
    }
    
    public function getCommentsByUser(User $user,Request $request)
    {
        return $user->comments()
            ->modelFilter(CommentFilter::class, $request->all())
            ->paginate($request->size);
    }

    public function commentOnPost(Post $post, FormRequest $request)
    {
        $validatedData = $request->validated();

        $comment = $this->commentRepo->create($validatedData);

        return $comment;
    }
}
