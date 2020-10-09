<?php

namespace App\Services\User;

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
        return $this->userRepo->getNewQuery()->paginate(10);
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
}