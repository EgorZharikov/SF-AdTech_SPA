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

    public function statistics(Request $request)
    {
        $data = request()->validate([
            'date' => 'date',
        ]);
        
        $totalCost = 0;
        $statistics = [];
        $dateStatistics = [];
        $dateCost = 0;
        $advertiserService = (new AdvertiserService);
        $statistics = $advertiserService->statisctics();
        $totalCost = round($advertiserService->totalCost, 2);
        
        if ($request->has('day')) {
            $dateStatistics = $advertiserService->dayStatistics();
            $dateCost = round($advertiserService->totalCost, 2);
            return response()->json(['dateStatistics' => $dateStatistics, 'dateCost' => $dateCost], 200);
        }

        if ($request->has('month')) {
            $dateStatistics = $advertiserService->monthStatistics();
            $dateCost = round($advertiserService->totalCost, 2);
            return response()->json(['dateStatistics' => $dateStatistics, 'dateCost' => $dateCost], 200);
        }

        if ($request->has('year')) {
            $dateStatistics = $advertiserService->yearStatistics();
            $dateCost = round($advertiserService->totalCost,2);
            return response()->json(['dateStatistics' => $dateStatistics, 'dateCost' => $dateCost], 200);
        }

        return response()->json(['statistics' => $statistics, 'totalCost' => $totalCost], 200);
        
    }
}
