<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Offer;
use App\Http\Resources\OfferResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

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
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'url' => 'required',
            'award' => 'required',
            'content' => 'required',
            'preview_image' => '',
            'topic_id' => '',
            'user_id'=> '',
            'status' => '',
            'unique_ip' => ''
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $offer = Offer::create($input);

        return $this->sendResponse(new OfferResource($offer), 'Offer created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): JsonResponse
    {
        $offer= Offer::find($id);

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
            'url' => 'required',
            'award' => 'required',
            'content' => 'required',
            'preview_image' => '',
            'topic_id' => '',
            'user_id' => '',
            'status' => '',
            'unique_ip' => ''
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
