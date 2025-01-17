<?php


namespace App\Services;

use App\Models\Fee;
use App\Models\Offer;
use App\Models\Redirect;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Contracts\Database\Query\Builder;

class WebmasterService
{
    public $totalAward;
    private $statistics;
    public $dateAward;
    private $dateStatistics;



    public function dayStatistics(): array
    {
        $this->dateAward = 0;
        $this->dateStatistics = [];

        $subscriptions = Subscription::where('user_id', Auth::id())->whereDate('created_at', '<=', date("Y-m-d", strtotime(request()->date)))->withCount(['redirects' => function (Builder $query) {
            $query->where('status', 1);
            $query->whereDate('created_at', date("Y-m-d", strtotime(request()->date)));
        }])->with((['redirects' => function (Builder $query) {
            $query->where('status', 1);
            $query->whereDate('created_at', date("Y-m-d", strtotime(request()->date)));
        }]))->get();

        foreach ($subscriptions as $subscription) {

            foreach ($subscription->redirects as $redirect) {
                $fee = round($redirect->fee, 2);
                $subscription->fee += round($redirect->offer_award * ($fee / 100), 2);
                $subscription->award += round($redirect->offer_award - $redirect->offer_award * ($fee / 100), 2, PHP_ROUND_HALF_DOWN);
                $subscription->offer_award = Offer::where('id', $subscription->offer_id)->first()->award;
               
            }
            $this->dateAward += $subscription->award;
            $this->dateStatistics[] = $subscription;
        }

        return $this->dateStatistics;
    }

    public function monthStatistics(): array
    {
        $this->dateAward = 0;
        $this->dateStatistics = [];

        $subscriptions = Subscription::where('user_id', Auth::id())->whereYear('created_at', '<=', date("Y", strtotime(request()->date)))->whereMonth('created_at', '<=', date("m", strtotime(request()->date)))->withCount(['redirects' => function (Builder $query) {
            $query->where('status', 1);
            $query->whereYear('created_at', date("Y", strtotime(request()->date)));
            $query->whereMonth('created_at', date("m", strtotime(request()->date)));
        }])->with((['redirects' => function (Builder $query) {
            $query->where('status', 1);
            $query->whereYear('created_at', date("Y", strtotime(request()->date)));
            $query->whereMonth('created_at', date("m", strtotime(request()->date)));
        }]))->get();

        foreach ($subscriptions as $subscription) {

            foreach ($subscription->redirects as $redirect) {
                $fee = round($redirect->fee, 2);
                $subscription->fee += round($redirect->offer_award * ($fee / 100), 2);
                $subscription->award += round($redirect->offer_award - $redirect->offer_award * ($fee / 100), 2, PHP_ROUND_HALF_DOWN);
                $subscription->offer_award = Offer::where('id', $subscription->offer_id)->first()->award;
                
            }
            $this->dateAward += $subscription->award;
            $this->dateStatistics[] = $subscription;
        }

        return $this->dateStatistics;
    }

    public function yearStatistics(): array
    {
        $this->dateAward = 0;
        $this->dateStatistics = [];

        $subscriptions = Subscription::where('user_id', Auth::id())->whereYear('created_at', '<=', date("Y", strtotime(request()->date)))->withCount(['redirects' => function (Builder $query) {
            $query->where('status', 1);
            $query->whereYear('created_at', date("Y", strtotime(request()->date)));
        }])->with((['redirects' => function (Builder $query) {
            $query->where('status', 1);
            $query->whereYear('created_at', date("Y", strtotime(request()->date)));
        }]))->get();

        foreach ($subscriptions as $subscription) {

            foreach ($subscription->redirects as $redirect) {
                $fee = round($redirect->fee, 2);
                $subscription->fee += round($redirect->offer_award * ($fee / 100), 2);
                $subscription->award += round($redirect->offer_award - $redirect->offer_award * ($fee / 100), 2, PHP_ROUND_HALF_DOWN);
                $subscription->offer_award = Offer::where('id', $subscription->offer_id)->first()->award;
                
            }
            $this->dateAward += $subscription->award;
            $this->dateStatistics[] = $subscription;
        }
        return $this->dateStatistics;
    }

    public function statisctics()
    {
        $this->totalAward = 0;
        $this->statistics = [];

        $subscriptions = Subscription::where('user_id', Auth::id())->withCount(['redirects' => function (Builder $query) {
            $query->where('status', 1);
        }])->with((['redirects' => function (Builder $query) {
            $query->where('status', 1);
        }]))->get();

        foreach ($subscriptions as $subscription) {

            foreach ($subscription->redirects as $redirect) {
                $fee = round($redirect->fee, 2);
                $subscription->fee += round($redirect->offer_award * ($fee / 100), 2);
                $subscription->award += round($redirect->offer_award - $redirect->offer_award * ($fee / 100), 2, PHP_ROUND_HALF_DOWN);
                $subscription->offer_award = Offer::where('id', $subscription->offer_id)->first()->award;
                
            }
            $this->totalAward += $subscription->award;
            $this->statistics[] = $subscription;
        }

        return $this->statistics;
    }

    public function profile()
    {
        $user = User::where('id', Auth::id())->with('fee')->first();

        return $user;
    }
}
