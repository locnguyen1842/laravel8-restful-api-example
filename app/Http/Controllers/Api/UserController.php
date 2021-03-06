<?php

namespace App\Http\Controllers\Api;

use App\Http\DTOs\User\UserCollection;
use App\Http\DTOs\User\UserResource;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
class UserController extends BaseApiController
{

    private $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
        
        $this->authorizeResource(User::class, 'user');
    }

    public function index(Request $request)
    {
        $users = $this->userService->all($request);

        return $this->response(new UserCollection($users));
    }

    public function store(StoreUserRequest $request)
    {
        $this->userService->store($request);

        return $this->responseNoContent();
    }

    public function show(User $user)
    {
        $user = $this->userService->show($user);
        
        return $this->response(new UserResource($user));
    }

    public function update(UpdateUserRequest $request,User $user)
    {
        $this->userService->update($request, $user);

        return $this->responseNoContent();
    }
    
    public function destroy(User $user)
    {
        $this->userService->delete($user);
        
        return $this->responseNoContent();
    }
}
