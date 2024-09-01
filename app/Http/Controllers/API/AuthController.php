<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\API\BaseController as BaseController;


class AuthController extends BaseController
{
    public function authentication()
    {
        $user = User::where('id', Auth::id())->with('wallet')->first();
        if ($user) {
            return response()->json(['data' => $user, 'message' => 'Authentication success!'], 200);
        } else {
            return response()->json(['data' => '', 'message' => 'Authentication fail.'], 200);
        }
    }
}
