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
use App\Http\Controllers\API\BaseController as BaseController;

class WebmasterController extends BaseController
{
    public function statistics(Request $request)
    {
        $statistics = [];
        $totalAward = 0;
        $userDate = $request->date;
        $dateStatistics = [];
        $dateAward = 0;

        $webmasterService = (new WebmasterService);

        $statistics = $webmasterService->statisctics();
        $totalAward = round($webmasterService->totalAward,2);

        return response()->json(['statistics' => $statistics, 'totalAward' => $totalAward], 200);
        // if ($request->has('day')) {
        //     $dateStatistics = $webmasterService->dayStatistics();
        //     $dateAward = $webmasterService->dateAward;
        // }

        // if ($request->has('month')) {
        //     $dateStatistics = $webmasterService->monthStatistics();
        //     $dateAward = $webmasterService->dateAward;
        // }

        // if ($request->has('year')) {
        //     $dateStatistics = $webmasterService->yearStatistics();
        //     $dateAward = $webmasterService->dateAward;
        // }

    }

    public function statisticsDate() {

    }

}
