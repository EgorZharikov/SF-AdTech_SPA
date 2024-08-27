<?php


namespace App\Services;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public static function store($request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email'],
            'password' => 'required',
            'role_id' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role_id' => $data['role_id'],
            ]);

            $wallet = Wallet::create([
                'balance' => 0,
                'user_id' => $user->id,
            ]);

            DB::commit();
            return response()->json(['message' => 'User added successfully!'], 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['errors' => $exception->getMessage()], 422);
        }
    }

    public static function ban(User $user): void
    {
        $user->banned_at = date("Y-m-d H:i:s");
        $user->save();
        $user->refresh();
    }

    public static function unban($user): void
    {
        $user->banned_at = null;
        $user->save();
        $user->refresh();
    }
}
