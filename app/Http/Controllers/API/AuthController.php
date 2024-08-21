<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class AuthController extends BaseController
{
    public function authentication()
    {

        $user = User::find(Auth::id());
        if ($user) {
            return response()->json($user, 200);
        } else {
            return response()->json(null, 200);
        }
    }
}
