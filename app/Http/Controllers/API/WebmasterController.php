<?php

namespace App\Http\Controllers\API;

use App\Models\Fee;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Redirect;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Services\WebmasterService;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\SubscriptionResource;
use App\Http\Controllers\API\BaseController as BaseController;

class WebmasterController extends BaseController
{
    public function statistics(Request $request)
    {
        $data = request()->validate([
            'date' => 'date',
        ]);
        $statistics = [];
        $totalAward = 0;
        $dateStatistics = [];
        $dateAward = 0;

        $webmasterService = (new WebmasterService);

        $statistics = $webmasterService->statisctics();
        $totalAward = round($webmasterService->totalAward,2);

        if ($request->has('day')) {
            $dateStatistics = $webmasterService->dayStatistics();
            $dateAward = round($webmasterService->dateAward,2);
            return response()->json(['dateStatistics' => $dateStatistics, 'dateAward' => $dateAward], 200);
        }

        if ($request->has('month')) {
            $dateStatistics = $webmasterService->monthStatistics();
            $dateAward = round($webmasterService->dateAward,2);
            return response()->json(['dateStatistics' => $dateStatistics, 'dateAward' => $dateAward], 200);
        }

        if ($request->has('year')) {
            $dateStatistics = $webmasterService->yearStatistics();
            $dateAward = round($webmasterService->dateAward,2);
            return response()->json(['dateStatistics' => $dateStatistics, 'dateAward' => $dateAward], 200);
        }
        return response()->json(['statistics' => $statistics, 'totalAward' => $totalAward], 200);
    }

    public function profile()
    {
        $webmasterService = (new WebmasterService);
        $user = $webmasterService->profile();
        return response()->json($user, 200);
    }
    public function subscriptions()
    {
        $subscriptions = Subscription::where('user_id', Auth::id())->where('status', 1)->get();
        return $this->sendResponse(SubscriptionResource::collection($subscriptions), 'Subscription retrieved successfully.');
    }

}
