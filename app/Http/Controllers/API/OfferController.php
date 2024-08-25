<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Offer;
use App\Models\Topic;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\OfferResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController as BaseController;

class OfferController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $offers = Offer::all();

        return $this->sendResponse(OfferResource::collection($offers), 'Offers retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): JsonResponse
    {


        $data = request()->validate([
            'title' => 'required',
            'url' => 'required|url',
            'award' => 'required|numeric',
            'content' => 'required',
            'topic' => 'required',
            'preview_image' => 'required|image|max:5120',
            'unique_ip' => 'numeric',
        ]);

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
            return $this->sendError($exception->getMessage());
        }

        return $this->sendResponse($offer, 'Offer created successfully');
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offer $offer): JsonResponse
    {
        $data = request()->validate([
            'title' => 'required',
            'url' => 'required|url',
            'award' => 'required|numeric',
            'content' => 'required',
            'topic' => 'required',
            'preview_image' => 'required|image|max:5120',
            'unique_ip' => 'numeric',
        ]);

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
                'award' => $data['award'],
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
            return $this->sendError($exception->getMessage());
        }

        return $this->sendResponse($offer, 'Offer updated successfully');;
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

    public function subscribe(Request $request, Offer $offer): JsonResponse
    {
        $subscription = Subscription::where('user_id', Auth::id())->where('offer_id', $offer->id)->first();
        if ($subscription === null) {
            Subscription::create([
                'user_id' => Auth::id(),
                'offer_id' => $offer->id,
                'referal_link' => Str::random(24),
            ]);
            return response()->json(['message' => 'Subcribe successfully.'], 200);
        }
        if (!$subscription->status) {
            $subscription->status = 1;
            $subscription->save();
            return response()->json(['message' => 'Subcribe successfully.'], 200);
        }

        return response()->json(['message' => 'You already subscribe.'], 422);
    }

    public function unsubscribe(Request $request, Offer $offer): JsonResponse
    {
        $subscription = Subscription::where('user_id', Auth::id())->where('offer_id', $offer->id)->first();
        if ($subscription) {
            $subscription->status = 0;
            $subscription->save();
            $subscription->refresh();
        } else {
            return response()->json(['message' => 'You not subscribed.'], 422);
        }
        return response()->json(['message' => 'Unsubscribe success.'], 200);
    }

    public function subscription(Request $request, Offer $offer): JsonResponse
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
}
