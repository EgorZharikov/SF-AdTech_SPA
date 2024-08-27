<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;

class UserController extends BaseController
{
    public function index()
    {
        $users = User::with('role')->get();
        return response()->json(['data' => $users], 200);
    }

    public function store(Request $request)
    {
        return UserService::store($request);
    }

    public function ban(User $user)
    {
        UserService::ban($user);
        return response()->json(['message' => 'User banned!'], 200);
    }

    public function unban(User $user)
    {
        UserService::unban($user);
        return response()->json(['message' => 'User unbanned!'], 200);
    }

}
