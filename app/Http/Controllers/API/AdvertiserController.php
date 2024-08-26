<?php

namespace App\Http\Controllers\API;

use App\Models\Fee;
use App\Models\User;
use App\Models\Offer;
use App\Models\Wallet;
use App\Models\Redirect;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Services\AdvertiserService;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\OfferResource;
use Illuminate\Contracts\Database\Query\Builder;
use App\Http\Controllers\API\BaseController as BaseController;

class AdvertiserController extends BaseController
{
    public function offers()
    {
        $offers = Offer::where('user_id', Auth::id())->with('topic')->get();
        if($offers) {
            return response()->json(['offers'=> OfferResource::collection($offers)], 200);
        } else {
            return response()->json(['messages' => 'Offers not found', 'offers' => ''], 200);
        }
    }

    public function profile()
    {
        $advertiserService = (new AdvertiserService);
        $user = $advertiserService->profile();
        return response()->json($user, 200);
    }
}
