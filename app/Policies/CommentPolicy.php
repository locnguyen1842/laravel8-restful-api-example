<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function viewPostComments(User $user)
    {
        if($user->can('read post comments')) {
            return true;
        }
    }

    public function viewUserComments(User $user, User $owner)
    {
        if($user->isAdmin()) {
            return true;
        }

        if($user->can('read user comments')) {
            return $user->id === $owner->id;
        }
    }

    public function leaveCommentOnPost(User $user)
    {
        if($user->can('leave comment on post')) {
            return true;
        }
    }

    public function update(User $user, Comment $comment)
    {
        if($user->isAdmin()) {
            return true;
        }

        if($user->can('update comments')) {
            return $comment->user->id === $user->id;
        }
    }

    public function delete(User $user, Comment $comment)
    {
        if($user->isAdmin()) {
            return true;
        }

        if($user->can('delete comments')) {
            return $comment->user->id === $user->id;
        }
    }
}
