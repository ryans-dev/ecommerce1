@if($tier_helper->isValid())
<style>
    .tier-checkout .tier-progress {
        height: 20px;
        background: rgba(43, 87, 47, 0.12);
        border-radius: 999px;
        overflow: hidden;
    }

    .tier-checkout .tier-text {
        display: inline;
        text-transform: capitalize;
        color: #2b572f;
    }

    .tier-checkout .tier-shape {
        padding: 20px;
        background: rgba(91, 153, 75, 0.08);
        border-radius: 18px;
    }

    .tier-checkout .tier-text-bigger {
        font-size: 2rem;
        line-height: 100%;
        text-transform: capitalize;
    }

    .tier-checkout .tier-card {
        background: #f3fbf1;
        border: 1px solid rgba(43, 87, 47, 0.16);
        border-radius: 24px;
        padding: 1.5rem;
    }
</style>

<div class="container my-5 tier-checkout">
    <div class="card tier-card">
        @if($tier_helper->tier_upgraded == 1)
            <div class="mb-4">
                <h3>Congratulations, your garden has grown!</h3>
                <p class="mb-0">You have reached <strong>{{ $tier_helper->tier->title }}</strong> and unlocked {{ $tier_helper->nickname }} status.</p>
            </div>
        @endif

        <div class="row align-items-center mb-4">
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="tier-shape text-center">
                    <div class="tier-text tier-text-bigger">{{ $tier_helper->tier->title }}</div>
                    <p class="mb-0 text-muted">{{ $tier_helper->nickname }}</p>
                </div>
            </div>
            <div class="col-md-8">
                <h4>Current Reward</h4>
                <p class="mb-3">{{ $tier_helper->current_rewards }}</p>
                @if ($tier_helper->hasNextTier())
                    <h5>Next Tier Goal</h5>
                    <p class="mb-1">Spend ${{ app('CustomHelper')->formatPrice($tier_helper->next_tier_amount) }} more to unlock <strong>{{ $tier_helper->next_tier_nickname }}</strong>.</p>
                    <div class="tier-progress mb-2">
                        <div class="progress-bar tier-progress-bar" role="progressbar" style="width: {{ $tier_helper->next_tier_percent }}%;" aria-valuenow="{{ $tier_helper->next_tier_percent }}" aria-valuemin="0" aria-valuemax="100">{{ $tier_helper->next_tier_percent }}%</div>
                    </div>
                @else
                    <p class="mb-0">You are at the highest tier and enjoying the full garden reward set.</p>
                @endif
            </div>
        </div>

        <div>
            <h4>Garden Badges</h4>
            @if (!empty($tier_helper->badges))
                <div class="row">
                    @foreach ($tier_helper->badges as $badge)
                        <div class="col-12 col-md-6 mb-3">
                            <div class="d-flex align-items-start">
                                <div class="mr-3" style="font-size: 1.5rem; color: #2b572f;"><i class="fas {{ $badge['icon'] }}"></i></div>
                                <div>
                                    <strong>{{ $badge['name'] }}</strong>
                                    <p class="mb-1 small text-muted">{{ $badge['description'] }}</p>
                                    <small class="text-muted">Earned {{ $badge['earned_at']->format('M d, Y') }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted mb-0">No badges yet. Keep growing your garden to earn your first leaf.</p>
            @endif
        </div>
    </div>
</div>
@endif
