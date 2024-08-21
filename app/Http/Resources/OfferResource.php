<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'url' => $this->url,
            'award' => $this->award,
            'content' => $this->content,
            'preview_image' => $this->imageUrl,
            'topic' => new TopicResource($this->topic),
            'user_id'=> $this->user_id,
            'status' => $this->status,
            'unique_ip' => $this->unique_ip,
        ];
    }
}
