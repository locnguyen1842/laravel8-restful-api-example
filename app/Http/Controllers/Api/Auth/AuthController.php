<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseApiController;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends AuthAbstract
{
    protected $model = User::class;
}
