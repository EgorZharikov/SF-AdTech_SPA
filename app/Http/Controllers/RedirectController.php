<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RedirectService;

class RedirectController extends Controller
{
    public function redirect($referal_link, Request $request)
    {
        return $redirector = (new RedirectService($referal_link, $request))->redirect();
    }
}
