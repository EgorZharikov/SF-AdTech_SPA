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
        return OfferService::store($request);
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
       return OfferService::update($request, $offer);
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
        return OfferService::subscribe($request, $offer);
    }

    public function unsubscribe(Request $request, Offer $offer)
    {
        return OfferService::unsubscribe($request, $offer);
    }

    public function subscription(Request $request, Offer $offer)
    {
        return OfferService::subscription($request, $offer);
    }

    public function unpublish(Offer $offer)
    {
       return OfferService::unpublish($offer);
    }

    public function publish(Offer $offer)
    {
        return OfferService::publish($offer);
    }
}
