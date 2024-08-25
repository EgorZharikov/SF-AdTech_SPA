<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'offer' => new OfferResource($this->offer),
            'id' => $this->id,
            'user_id' => $this->user_id,
            'offer_id' => $this->offer_id,
            'referal_link' => $this->referal_link,
            'status' => $this->status,
        ];
    }
}
