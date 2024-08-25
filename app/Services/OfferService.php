<?php


namespace App\Services;

use App\Models\Offer;

class OfferService
{
    public static function statusChange(int $offerId)
    {
        $offer = Offer::where('id', $offerId)->first();
        $offer->status = 2;
        $offer->save();
        $offer->refresh();
    }
}
