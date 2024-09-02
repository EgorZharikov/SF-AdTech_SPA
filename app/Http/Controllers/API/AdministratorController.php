<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Fee;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use App\Services\AdministratorService;
use App\Http\Controllers\API\BaseController as BaseController;

class AdministratorController extends BaseController
{
    public function profile()
    {
        $user = User::where('id', Auth::id())->first();
        return response()->json($user, 200);
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

    public function systemWallet()
    {
        $wallet =  Wallet::where('system_code', 101)->first();
        $walletIncome = Wallet::where('system_code', 102)->first();
        return response()->json(['total' => $wallet, 'income' => $walletIncome], 200);
    }

    public function systemFee()
    {
        $fee = Fee::where('id', 1)->first();
        return response()->json($fee, 200);
    }

    public function updateSystemFee(Request $request)
    {
        $data = $request->validate([
            'amount' => ['required', 'numeric'],
        ]);

        $fee = Fee::where('id', 1)->first();
        $fee->percent = round($data['amount'],2);
        $fee->save();
        $fee->refresh();
        return response()->json($fee, 200);
    }
}