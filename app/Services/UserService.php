<?php

namespace App\Services;

use App\ModelFilters\UserFilter;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use libphonenumber\PhoneNumberFormat;
use Propaganistas\LaravelPhone\PhoneNumber;

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

    public function store(FormRequest $request)
    {
        return \DB::transaction(function () use($request) {
            $validatedData = $request->validated();
            
            $validatedData['password'] = bcrypt($validatedData['password']);

            $user = $this->userRepo->create($validatedData);

            $user->assignRole($validatedData['role']);

            return $user;
        });

    }
    
    public function update(FormRequest $request, User $user)
    {
        $validatedData = $request->validated();

        return $this->userRepo->update($validatedData, $user->id);
    }

    public function delete(User $user)
    {
        return $user->delete();
    }
}