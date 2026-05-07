<style>
    .custom-tier-area1 {
        background: linear-gradient(135deg, #eaf7e0 0%, #d1e8ca 100%);
        border-radius: 24px;
    }

    .custom-tier-area1 h2,
    .custom-tier-area1 h4,
    .custom-tier-area1 p {
        margin-bottom: 0.75rem;
    }

    .custom-tier-area1 .tier-heading {
        font-weight: 700;
        color: #2b572f;
    }

    .custom-tier-area1 .tier-progress {
        height: 18px;
        background-color: rgba(43, 87, 47, 0.14);
        border-radius: 999px;
        overflow: hidden;
        border: 1px solid rgba(43, 87, 47, 0.2);
    }

    .custom-tier-area1 .tier-progress-bar {
        height: 100%;
        background: linear-gradient(90deg, #5f9e6b 0%, #93c56a 100%);
    }

    .custom-tier-area1 .badge-card {
        border: 1px solid rgba(43, 87, 47, 0.16);
        border-radius: 18px;
        background: #fff;
        padding: 1rem;
    }

    .custom-tier-area1 .badge-icon {
        width: 48px;
        height: 48px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(91, 153, 75, 0.12);
        color: #2b572f;
    }
</style>

<div class="container1 my-51">
    <div class="card1 custom-tier-area1 p-4">
        <div class="row align-items-center mb-4">
            <div class="col-md-8">
                <h2 class="tier-heading">Garden Growth Dashboard</h2>
                <p class="text-muted">Watch your plant-powered rewards grow as you spend, earn badges, and unlock new tier perks.</p>
            </div>
            <div class="col-md-4 text-md-right">
                <p class="mb-1"><strong>Garden Nickname:</strong> {{ $tier_helper->nickname }}</p>
                <p class="mb-0"><strong>Growth Points:</strong> {{ $tier_helper->points }}</p>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-4 badge-card mb-3 mb-md-0">
                <h4 class="tier-heading">Current Tier</h4>
                <p class="mb-1"><strong>{{ Str::ucfirst($tier_helper->tier->title) }}</strong></p>
                <p class="small text-muted">{{ $tier_helper->current_rewards }}</p>
            </div>
            @if ($tier_helper->hasNextTier())
            <div class="col-md-4 badge-card mb-3 mb-md-0">
                <h4 class="tier-heading">Next Tier</h4>
                <p class="mb-1"><strong>{{ Str::ucfirst($tier_helper->next_tier->title) }}</strong></p>
                <p class="small text-muted">{{ $tier_helper->next_rewards }}</p>
            </div>
            <div class="col-md-4 badge-card">
                <h4 class="tier-heading">Tier Goal</h4>
                <p class="mb-1">${{ app('CustomHelper')->formatPrice($tier_helper->next_tier_amount) }} to reach <strong>{{ $tier_helper->next_tier_nickname }}</strong></p>
                <div class="tier-progress mb-2">
                    <div class="tier-progress-bar" style="width: {{ $tier_helper->next_tier_percent }}%;"></div>
                </div>
                <small class="text-muted">{{ $tier_helper->next_tier_percent }}% towards next tier</small>
            </div>
            @else
            <div class="col-md-8 badge-card">
                <h4 class="tier-heading">Garden Champion</h4>
                <p class="mb-0 text-muted">You have unlocked the highest tier and all premium plant perks.</p>
            </div>
            @endif
        </div>

        <div class="row mb-4">
            <div class="col-md-6 badge-card">
                <h4 class="tier-heading">Total Spending</h4>
                <p class="mb-2">${{ app('CustomHelper')->formatPrice($tier_helper->spending) }}</p>
                <div class="tier-progress">
                    <div class="tier-progress-bar" style="width: {{ $tier_helper->hasNextTier() ? $tier_helper->max_tier_percent : 100 }}%;"></div>
                </div>
                <small class="text-muted">{{ $tier_helper->hasNextTier() ? $tier_helper->max_tier_percent . '% of max tier progress' : 'Max tier achieved' }}</small>
            </div>
            <div class="col-md-6 badge-card">
                <h4 class="tier-heading">Garden Badges</h4>
                @if (!empty($tier_helper->badges))
                    <div class="row">
                        @foreach ($tier_helper->badges as $badge)
                            <div class="col-12 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="badge-icon mr-3">
                                        <i class="fas {{ $badge['icon'] }}"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">{{ $badge['name'] }}</h6>
                                        <p class="small text-muted mb-0">{{ $badge['description'] }}</p>
                                        <small class="text-muted">Earned {{ $badge['earned_at']->format('M d, Y') }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="mb-0 text-muted">No badges yet. Keep shopping to unlock your first garden badge.</p>
                @endif
            </div>
        </div>
    </div>
</div>
