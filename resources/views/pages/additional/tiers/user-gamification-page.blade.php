<x-mylayouts.layout-default title="My Profile">
    <x-mylayouts.inner-layout-user>
        <div class="row mb-4">
            <div class="col-12">
                <div class="card p-4">
                    <h2 class="mb-3">My Profile</h2>
                    <p class="text-muted">Manage your account details and track your gamification progress.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card p-4">
                    <ul class="nav nav-tabs" id="profileTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">My Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="gamification-tab" data-toggle="tab" href="#gamification" role="tab" aria-controls="gamification" aria-selected="false">Gamification</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-4" id="profileTabsContent">
                        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <h3 class="mb-3">Account Information</h3>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <strong>Name</strong>
                                    <p>{{ $user->name }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <strong>Email</strong>
                                    <p>{{ $user->email }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <strong>Orders Completed</strong>
                                    <p>{{ $ordersCount }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <strong>Last Paid Order</strong>
                                    <p>{{ optional($lastOrder)->created_at?->format('M d, Y') ?? 'No completed orders yet' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <strong>Member Since</strong>
                                    <p>{{ $user->created_at->format('M d, Y') }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <strong>Total Spending</strong>
                                    <p>${{ app('CustomHelper')->formatPrice($tier_helper->spending) }}</p>
                                </div>
                            </div>
                            <p class="text-muted mb-0">To update your personal details, please contact support.</p>
                        </div>
                        <div class="tab-pane fade" id="gamification" role="tabpanel" aria-labelledby="gamification-tab">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="card p-4 mb-4">
                                        <h3 class="mb-3">Current Tier & Rewards</h3>
                                        <p><strong>{{ Str::ucfirst($tier_helper->tier->title) }}</strong> — <em>{{ $tier_helper->nickname }}</em></p>
                                        <p class="text-muted">{{ $tier_helper->current_rewards }}</p>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <strong>Growth Points</strong>
                                                <p>{{ $tier_helper->points }}</p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <strong>Total Spending</strong>
                                                <p>${{ app('CustomHelper')->formatPrice($tier_helper->spending) }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card p-4">
                                        <h3 class="mb-3">Garden Badges</h3>
                                        @if (!empty($tier_helper->badges))
                                            <div class="row">
                                                @foreach ($tier_helper->badges as $badge)
                                                    <div class="col-12 mb-3">
                                                        <div class="border rounded p-3">
                                                            <div class="d-flex align-items-start">
                                                                <div class="mr-3 text-success" style="font-size: 1.5rem; width: 48px; text-align: center;">
                                                                    <i class="fas {{ $badge['icon'] }}"></i>
                                                                </div>
                                                                <div>
                                                                    <strong>{{ $badge['name'] }}</strong>
                                                                    <p class="mb-1 text-muted">{{ $badge['description'] }}</p>
                                                                    <small class="text-muted">Earned {{ $badge['earned_at']->format('M d, Y') }}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p class="text-muted">No badges earned yet. Keep growing to unlock your first badge.</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="card p-4 mb-4">
                                        <h3 class="mb-3">Next Tier Preview</h3>
                                        @if ($tier_helper->hasNextTier())
                                            <p><strong>{{ Str::ucfirst($tier_helper->next_tier->title) }}</strong> — <em>{{ $tier_helper->next_tier_nickname }}</em></p>
                                            <p class="text-muted">{{ $tier_helper->next_rewards }}</p>
                                            <hr>
                                            <p><strong>${{ app('CustomHelper')->formatPrice($tier_helper->next_tier_amount) }}</strong> needed to unlock</p>
                                            <div class="progress mb-2" style="height: 16px; background: rgba(43, 87, 47, 0.12); border-radius: 999px;">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $tier_helper->next_tier_percent }}%;" aria-valuenow="{{ $tier_helper->next_tier_percent }}" aria-valuemin="0" aria-valuemax="100">{{ $tier_helper->next_tier_percent }}%</div>
                                            </div>
                                        @else
                                            <p class="text-muted">You are at the highest tier and have unlocked the full garden reward set.</p>
                                        @endif
                                    </div>

                                    <div class="card p-4">
                                        <h3 class="mb-3">Tier Progress</h3>
                                        <p class="mb-2">Progress toward the highest tier</p>
                                        <div class="progress" style="height: 16px; background: rgba(43, 87, 47, 0.12); border-radius: 999px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $tier_helper->hasNextTier() ? $tier_helper->max_tier_percent : 100 }}%;" aria-valuenow="{{ $tier_helper->hasNextTier() ? $tier_helper->max_tier_percent : 100 }}" aria-valuemin="0" aria-valuemax="100">{{ $tier_helper->hasNextTier() ? $tier_helper->max_tier_percent : 100 }}%</div>
                                        </div>
                                        <p class="mt-3 mb-0 text-muted">{{ $tier_helper->hasNextTier() ? 'Max tier progress' : 'Top tier achieved' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-mylayouts.inner-layout-user>
</x-mylayouts.layout-default>
