<?php

namespace App\Services;

use App\ModelFilters\CommentFilter;
use App\Models\Post;
use App\Models\User;
use App\Repositories\Contracts\CommentRepositoryInterface;
use Illuminate\Http\Request;

class CommentService {

    private $commentRepo;

    public function __construct(CommentRepositoryInterface $commentRepo) 
    {
        $this->commentRepo = $commentRepo;
    }

    public function getCommentsByPost(Post $post,Request $request)
    {
        /** @phpstan-ignore-next-line */
        $comments = $post->comments;
        
        $comments->toQuery()->modelFilter(CommentFilter::class, $request->all());

        return $comments->paginate($request->size);
    }
    
    public function getCommentsByUser(User $user,Request $request)
    {
        /** @phpstan-ignore-next-line */
        $comments = $user->comments;
        
        $comments->toQuery()->modelFilter(CommentFilter::class, $request->all());
        
        return $comments->paginate($request->size);
    }
}
