<?php

namespace App\Http\Controllers\API;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\SubscriptionResource;
use App\Models\Subscription;

class SubscriptionController extends BaseController
{
    public function index()
    {
        $subscriptions = Subscription::where('user_id', Auth::id())->where('status', 1)->get();
        return $this->sendResponse(SubscriptionResource::collection($subscriptions), 'Subscription retrieved successfully.');
    
    }
}
