<?php


namespace App\Services;

use App\Models\User;
use App\Models\Offer;
use App\Models\Redirect;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Contracts\Database\Query\Builder;

class AdvertiserService
{
    public $totalCost;
    private $statistics;



    public function dayStatistics(): array
    {

        $this->totalCost = 0;
        $this->statistics = [];

        $offers = Offer::where('user_id', Auth::id())->whereDate('created_at', '<=', date("Y-m-d", strtotime(request()->date)))->withCount(['subscriptions' => function (Builder $query) {
                $query->withTrashed();
                $query->whereDay('created_at', date("d", strtotime(request()->date)));
                $query->whereMonth('created_at', date("m", strtotime(request()->date)));
                $query->whereYear('created_at', date("Y", strtotime(request()->date)));
            }])->get();
        foreach ($offers as $offer) {
            $dayRedirects = 0;
            foreach ($offer->subscriptions()->withTrashed()->get() as $subscription) {
                $dayRedirects = Redirect::where('subscription_id', $subscription->id)->where('status', 1)->whereDay('created_at', date("d", strtotime(request()->date)))->whereMonth('created_at', date("m", strtotime(request()->date)))->whereYear('created_at', date("Y", strtotime(request()->date)))->count();
            }
            $offer->redirects_count = $dayRedirects;
            $offer->subscriptions_now = Subscription::where('offer_id', $offer->id)->where('status', 1)->whereDay('created_at', date("d", strtotime(request()->date)))->whereMonth('created_at', date("m", strtotime(request()->date)))->whereYear('created_at', date("Y", strtotime(request()->date)))->count();
            $offer->cost = round($offer->award * $offer->redirects_count, 2);
            $this->totalCost += round($offer->cost, 2);
            $this->statistics[] = $offer;
        }
        return $this->statistics;
    }

    public function monthStatistics(): array
    {
        $this->totalCost = 0;
        $this->statistics = [];

        $offers = Offer::where('user_id', Auth::id())->whereYear('created_at', '<=', date("Y", strtotime(request()->date)))->whereMonth('created_at', '<=', date("m", strtotime(request()->date)))->withCount(['subscriptions' => function (Builder $query) {
                $query->withTrashed();
                $query->whereMonth('created_at', date("m", strtotime(request()->date)));
                $query->whereYear('created_at', date("Y", strtotime(request()->date)));
            }])->get();
        foreach ($offers as $offer) {
            $monthRedirects = 0;
            foreach ($offer->subscriptions()->withTrashed()->get() as $subscription) {
                $monthRedirects = Redirect::where('subscription_id', $subscription->id)->where('status', 1)->whereMonth('created_at', date("m", strtotime(request()->date)))->whereYear('created_at', date("Y", strtotime(request()->date)))->count();
            }
            $offer->redirects_count = $monthRedirects;
            $offer->subscriptions_now = Subscription::where('offer_id', $offer->id)->where('status', 1)->whereMonth('created_at', date("m", strtotime(request()->date)))->whereYear('created_at', date("Y", strtotime(request()->date)))->count();
            $offer->cost = round($offer->award * $offer->redirects_count, 2);
            $this->totalCost += round($offer->cost, 2);
            $this->statistics[] = $offer;
        }
        return $this->statistics;
    }

    public function yearStatistics(): array
    {
        $this->totalCost = 0;
        $this->statistics = [];

        $offers = Offer::where('user_id', Auth::id())->whereYear('created_at', '<=', date("Y", strtotime(request()->date)))->withCount(['subscriptions' => function (Builder $query) {
                $query->withTrashed();
                $query->whereYear('created_at', date("Y", strtotime(request()->date)));
            }])->get();
        foreach ($offers as $offer) {
            $yearRedirects = 0;
            foreach ($offer->subscriptions()->withTrashed()->get() as $subscription) {
                $yearRedirects = Redirect::where('subscription_id', $subscription->id)->where('status', 1)->whereYear('created_at', date("Y", strtotime(request()->date)))->count();
            }
            $offer->redirects_count = $yearRedirects;
            $offer->subscriptions_now = Subscription::where('offer_id', $offer->id)->where('status', 1)->whereYear('created_at', date("Y", strtotime(request()->date)))->count();
            $offer->cost = round($offer->award * $offer->redirects_count, 2);
            $this->totalCost += round($offer->cost, 2);
            $this->statistics[] = $offer;
        }
        return $this->statistics;
    }

    public function statisctics()
    {

        $this->totalCost = 0;
        $this->statistics = [];

        $offers = Offer::where('user_id', Auth::id())->withCount(['subscriptions' => function (Builder $query) {
            $query->withTrashed();
        }])->get();
        foreach ($offers as $offer) {
            $redirects = 0;
            foreach ($offer->subscriptions()->withTrashed()->get() as $subscription) {
                $redirects = Redirect::where('subscription_id', $subscription->id)->where('status', 1)->get()->count();
            }
            $offer->redirects_count = $redirects;
            $offer->cost = round($offer->award * $offer->redirects_count,2);
            $this->totalCost += round($offer->cost,2);
            $offer->subscriptions_now = Subscription::where('offer_id', $offer->id)->where('status', 1)->count();
            $this->statistics[] = $offer;
        }
        return $this->statistics;
    }
    
    public function profile()
    {
        $user = User::where('id', Auth::id())->first();

        return $user;
    }
}
