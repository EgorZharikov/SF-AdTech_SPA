<?php


namespace App\Services;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Offer;
use App\Models\Topic;
use App\Models\Wallet;
use Illuminate\Support\Str;
use App\Models\Subscription;
use App\Events\NotificationEvent;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\OfferResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OfferService
{
    public static function statusChange(int $offerId)
    {
        $offer = Offer::where('id', $offerId)->first();
        $offer->status = 2;
        $offer->save();
        $offer->refresh();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public static function store(Request $request)
    {
        $data = request()->validate([
            'title' => 'required',
            'url' => 'required|url',
            'award' => 'required|numeric|min:0.1',
            'content' => 'required',
            'topic' => 'required',
            'preview_image' => 'required|image|max:5120',
            'unique_ip' => 'numeric',
        ]);

        $wallet = Wallet::where('user_id', Auth::id())->first();
        if ($wallet->balance < $data['award']) {
            return response()->json(['errors' => ['balance' => ['Insufficient funds!']]], 422);
        }

        try {

            DB::beginTransaction();
            $image = $data['preview_image'];
            $name = md5(Carbon::now() . '_' . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
            $filePath = Storage::disk('public')->putFileAs('/previews', $image, $name);
            $data['preview_image'] = $filePath;

            $topic = Topic::firstOrCreate([
                'name' => $data['topic'],
            ]);

            $offer = Offer::create([
                'title' => $data['title'],
                'url' => $data['url'],
                'award' => $data['award'],
                'content' => $data['content'],
                'preview_image' => $data['preview_image'],
                'topic_id' => $topic->id,
                'user_id' => Auth::id(),
                'unique_ip' => $data['unique_ip'],
            ]);

            DB::commit();
        } catch (\Exception $exception) {
            Storage::disk('public')->delete($data['preview_image']);
            DB::rollBack();
            return self::sendError($exception->getMessage());
        }

        return self::sendResponse($offer, 'Offer created successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public static function update(Request $request, Offer $offer)
    {
        $data = request()->validate([
            'title' => 'required',
            'url' => 'required|url',
            'content' => 'required',
            'topic' => 'required',
            'preview_image' => 'required|image|max:5120',
            'unique_ip' => 'numeric',
        ]);
        $wallet = Wallet::where('user_id', Auth::id())->first();
        if ($wallet->balance < $offer->award) {
            return response()->json(['errors' => ['balance' => ['Insufficient funds!']]], 422);
        }

        try {
            DB::beginTransaction();
            Storage::disk('public')->delete($offer->preview_image);
            $image = $data['preview_image'];
            $name = md5(Carbon::now() . '_' . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
            $filePath = Storage::disk('public')->putFileAs('/previews', $image, $name);
            $data['preview_image'] = $filePath;

            $topic = Topic::firstOrCreate([
                'name' => $data['topic'],
            ]);

            $offer->update([
                'title' => $data['title'],
                'url' => $data['url'],
                'content' => $data['content'],
                'preview_image' => $data['preview_image'],
                'topic_id' => $topic->id,
                'user_id' => Auth::id(),
                'unique_ip' => $data['unique_ip']
            ]);

            DB::commit();
        } catch (\Exception $exception) {
            Storage::disk('public')->delete($data['preview_image']);
            DB::rollBack();
            return self::sendError($exception->getMessage());
        }

        return self::sendResponse($offer, 'Offer updated successfully');;
    }

    public static function subscribe(Request $request, Offer $offer)
    {
        $subscription = Subscription::where('user_id', Auth::id())->where('offer_id', $offer->id)->first();
        if ($subscription === null) {
            Subscription::create([
                'user_id' => Auth::id(),
                'offer_id' => $offer->id,
                'referal_link' => Str::random(24),
            ]);
            $message = 'User ' . Auth::user()->name . ' subscribe to you offer id:' . $offer->id;
            event(new NotificationEvent($message, $offer->user_id, 'success'));
            return response()->json(['message' => 'Subcribe successfully.'], 200);
        }
        if (!$subscription->status) {
            $subscription->status = 1;
            $subscription->save();
            $message = 'User ' . Auth::user()->name . ' subscribe to you offer id:' . $offer->id;
            event(new NotificationEvent($message, $offer->user_id, 'success'));
            return response()->json(['message' => 'Subcribe successfully.'], 200);
        }

        return response()->json(['message' => 'You already subscribe.'], 422);
    }

    public static function unsubscribe(Request $request, Offer $offer)
    {
        $subscription = Subscription::where('user_id', Auth::id())->where('offer_id', $offer->id)->first();
        if ($subscription) {
            $subscription->status = 0;
            $subscription->save();
            $subscription->refresh();
        } else {
            return response()->json(['message' => 'You not subscribed.'], 422);
        }
        $message = 'User ' . Auth::user()->name . ' unsubscribe to you offer id:' . $offer->id;
        event(new NotificationEvent($message, $offer->user_id, 'info'));
        return response()->json(['message' => 'Unsubscribe success.'], 200);
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private static function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    /**
     * return error response.S
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private static function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
