<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Offer;
use App\Models\Topic;
use App\Models\Wallet;
use Illuminate\Support\Str;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Events\NotificationEvent;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\OfferResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Services\OfferService;

class OfferController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $offers = Offer::where('status', 1)->get();

        return $this->sendResponse(OfferResource::collection($offers), 'Offers retrieved successfully.');
    }
   
    public function store(Request $request)
    {
        OfferService::store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): JsonResponse
    {
        $offer = Offer::find($id);

        if (is_null($offer)) {
            return $this->sendError('Offer not found.');
        }

        return $this->sendResponse(new OfferResource($offer), 'Offer retrieved successfully.');
    }

    
    public function update(Request $request, Offer $offer)
    {
        OfferService::update($request, $offer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer): JsonResponse
    {
        $offer->delete();

        return $this->sendResponse([], 'Offer deleted successfully.');
    }

    public function subscribe(Request $request, Offer $offer)
    {
        OfferService::subscribe($request, $offer);
    }

    public function unsubscribe(Request $request, Offer $offer)
    {
        OfferService::unsubscribe($request, $offer);
    }

    public function subscription(Request $request, Offer $offer)
    {
        $subscription = Subscription::where('user_id', Auth::id())->where('offer_id', $offer->id)->first();

        if ($subscription === null) {
            return response()->json(['subscribed' => 0], 200);
        }
        if (!$subscription->status) {
            return response()->json(['subscribed' => 0], 200);
        }


        return response()->json(['subscribed' => 1], 200);
    }

    public function unpublish(Offer $offer)
    {
        $offer->status = 0;
        $offer->save();
        $offer->refresh();

        return $this->sendResponse(new OfferResource($offer), 'Offer retrieved successfully.');
    }

    public function publish(Offer $offer)
    {
        $offer->status = 1;
        $offer->save();
        $offer->refresh();

        return self::sendResponse(new OfferResource($offer), 'Offer retrieved successfully.');
    }
}
