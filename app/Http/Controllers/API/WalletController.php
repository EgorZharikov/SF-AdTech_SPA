<?php

namespace App\Http\Controllers\API;

use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Services\WalletService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;

class WalletController extends BaseController
{
    public function show()
    {
        $wallet = Wallet::where('user_id', Auth::id())->first();

        if (is_null($wallet)) {
            return $this->sendError('Offer not found.');
        }

        return $this->sendResponse($wallet, 'Wallet retrieved successfully.');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'amount' => ['required', 'numeric'],
            'replenish' => '',
            'withdraw' => '',
        ]);
        if ($request->has('replenish')) {
            return WalletService::replenish($data['amount']);
        } elseif ($request->has('withdraw')) {
            return WalletService::withdraw($data['amount']);
        }
    }
}
