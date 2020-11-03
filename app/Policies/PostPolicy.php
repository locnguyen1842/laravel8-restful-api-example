<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if($user->can('read posts')) {
            return true;
        }
    }

    public function view(User $user, Post $post)
    {
        if($user->can('read posts')) {
            return true;
        }
    }

    public function create(User $user)
    {
        if($user->can('create posts')) {
            return true;
        }
    }

    public function update(User $user, Post $post)
    {
        if($user->isAdmin()) {
            return true;
        }

        if($user->can('update posts')) {
            return $post->user->id === $user->id;
        }
    }

    public function delete(User $user, Post $post)
    {
        if($user->isAdmin()) {
            return true;
        }

        if($user->can('delete posts')) {
            return $post->user->id === $user->id;
        }
    }
}
