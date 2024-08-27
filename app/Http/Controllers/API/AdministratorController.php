<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\AdministratorService;
use App\Services\UserService;
use App\Http\Controllers\API\BaseController as BaseController;

class AdministratorController extends BaseController
{
    public function profile()
    {
        $user = User::where('id', Auth::id())->first();
        return view('dashboard.administrator.profile', compact('user'));
    }

    public function statistics(Request $request)
    {
        $statistics = [];
        $dateStatistics = [];

        $administratorService = (new AdministratorService);
        $statistics = $administratorService->statistics();

        if ($request->has('day')) {
            $dateStatistics = $administratorService->dayStatistics();
            return response()->json(['dateStatistics' => $dateStatistics], 200);
        }

        if ($request->has('month')) {
            $dateStatistics = $administratorService->monthStatistics();
            return response()->json(['dateStatistics' => $dateStatistics], 200);
        }

        if ($request->has('year')) {
            $dateStatistics = $administratorService->yearStatistics();
            return response()->json(['dateStatistics' => $dateStatistics], 200);
        }
        return response()->json(['statistics' => $statistics], 200);
    }

    public function wallet()
    {
        $wallet =  Wallet::where('system_code', 101)->first();
        $walletIncome = Wallet::where('system_code', 102)->first();
        return view('dashboard.administrator.wallet', compact('wallet', 'walletIncome'));
    }
}