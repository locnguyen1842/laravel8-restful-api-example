<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if($user->isAdmin()) {
            return true;
        }
    }

    public function view(User $user, User $model)
    {
        if($user->isAdmin()) {
            return true;
        }
        
        if($user->can('read users')) {
            return $user->id === $model->id;
        }
    }

    public function create(User $user)
    {
        if($user->isAdmin()) {
            return true;
        }
    }

    public function update(User $user, User $model)
    {
        if($user->isAdmin()) {
            return true;
        }
        
        if($user->can('update users')) {
            return $user->id === $model->id;
        }
    }

    public function delete(User $user, User $model)
    {
        if($user->isAdmin()) {
            return true;
        }
    }
}
