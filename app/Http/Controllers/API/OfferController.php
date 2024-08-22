<?php

namespace App\Http\Controllers\API;

use App\Models\Offer;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\OfferResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController as BaseController;
use Carbon\Carbon;

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
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'url' => ['required', 'url'],
            'award' => ['required', 'numeric'],
            'content' => 'required',
            'topic' => ['required', 'string'],
            'preview_image' => ['required', 'image'],
            'uniqueIp' => '',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $offer->title = $input['title'];
        $offer->url = $input['url'];
        $offer->award = $input['award'];
        $offer->content = $input['content'];
        $offer->preview_image = $input['preview_image'];
        $offer->status = $input['status'];
        $offer->unique_ip = $input['unique_ip'];

        $offer->save();

        return $this->sendResponse(new OfferResource($offer), 'Offer updated successfully.');
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
}
