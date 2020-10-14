<?php

namespace App\Services\User;

use App\ModelFilters\UserFilter;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserService {

    private $userRepo;

    public function __construct(UserRepositoryInterface $userRepo) {
        $this->userRepo = $userRepo;
    }

    public function all(Request $request)
    {
        $users = $this->userRepo->modelFilter(UserFilter::class, $request->all())->paginate($request->size);
        return $users;
    }

    public function show(User $user)
    {
        return $user;
    }

    public function store(Request $request)
    {
        $validatedData = $request->validated();
        return $this->userRepo->create($validatedData);
    }
    
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validated();
        return $this->userRepo->update($validatedData, $user->id);
    }

    public function delete(User $user)
    {
        return $user->delete();
    }
}