<?php

namespace App\Http\Controllers;

use App\Helpers\TierHelper;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function gamification()
    {
        $user = Auth::user();
        $tier_helper = new TierHelper($user);
        $tier_helper->checkTierProgress();

        if (! $tier_helper->isValid()) {
            abort(404);
        }

        $ordersCount = $user->orders()->count();
        $lastOrder = $user->orders()->where('payment_status', 'paid')->latest()->first();

        return view('pages.additional.tiers.user-gamification-page', compact('tier_helper', 'user', 'ordersCount', 'lastOrder'));
    }
}
