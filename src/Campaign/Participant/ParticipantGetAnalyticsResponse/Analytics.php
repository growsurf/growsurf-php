<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\ParticipantGetAnalyticsResponse;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type AnalyticsShape = array{
 *   currencyISO?: string|null,
 *   expiredReferrals?: int|null,
 *   impressions?: int|null,
 *   invitesSent?: int|null,
 *   leads?: int|null,
 *   monthlyReferrals?: int|null,
 *   pendingRewards?: int|null,
 *   referralRevenue?: int|null,
 *   referrals?: int|null,
 *   rewardsEarned?: int|null,
 *   totalCommissions?: int|null,
 *   totalPaidOut?: int|null,
 *   uniqueImpressions?: int|null,
 *   upcomingPayout?: int|null,
 * }
 */
final class Analytics implements BaseModel
{
    /** @use SdkModel<AnalyticsShape> */
    use SdkModel;

    #[Optional]
    public ?string $currencyISO;

    #[Optional]
    public ?int $expiredReferrals;

    #[Optional]
    public ?int $impressions;

    #[Optional]
    public ?int $invitesSent;

    #[Optional]
    public ?int $leads;

    #[Optional]
    public ?int $monthlyReferrals;

    #[Optional]
    public ?int $pendingRewards;

    /**
     * Affiliate only. Revenue attributed to this participant's referrals, in minor currency units.
     */
    #[Optional]
    public ?int $referralRevenue;

    #[Optional]
    public ?int $referrals;

    #[Optional]
    public ?int $rewardsEarned;

    /**
     * Affiliate only. Total commissions earned, in minor currency units.
     */
    #[Optional]
    public ?int $totalCommissions;

    /**
     * Affiliate only. Total paid out, in minor currency units.
     */
    #[Optional]
    public ?int $totalPaidOut;

    #[Optional]
    public ?int $uniqueImpressions;

    /**
     * Affiliate only. Approved commissions ready to pay, in minor currency units.
     */
    #[Optional]
    public ?int $upcomingPayout;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $currencyISO = null,
        ?int $expiredReferrals = null,
        ?int $impressions = null,
        ?int $invitesSent = null,
        ?int $leads = null,
        ?int $monthlyReferrals = null,
        ?int $pendingRewards = null,
        ?int $referralRevenue = null,
        ?int $referrals = null,
        ?int $rewardsEarned = null,
        ?int $totalCommissions = null,
        ?int $totalPaidOut = null,
        ?int $uniqueImpressions = null,
        ?int $upcomingPayout = null,
    ): self {
        $self = new self;

        null !== $currencyISO && $self['currencyISO'] = $currencyISO;
        null !== $expiredReferrals && $self['expiredReferrals'] = $expiredReferrals;
        null !== $impressions && $self['impressions'] = $impressions;
        null !== $invitesSent && $self['invitesSent'] = $invitesSent;
        null !== $leads && $self['leads'] = $leads;
        null !== $monthlyReferrals && $self['monthlyReferrals'] = $monthlyReferrals;
        null !== $pendingRewards && $self['pendingRewards'] = $pendingRewards;
        null !== $referralRevenue && $self['referralRevenue'] = $referralRevenue;
        null !== $referrals && $self['referrals'] = $referrals;
        null !== $rewardsEarned && $self['rewardsEarned'] = $rewardsEarned;
        null !== $totalCommissions && $self['totalCommissions'] = $totalCommissions;
        null !== $totalPaidOut && $self['totalPaidOut'] = $totalPaidOut;
        null !== $uniqueImpressions && $self['uniqueImpressions'] = $uniqueImpressions;
        null !== $upcomingPayout && $self['upcomingPayout'] = $upcomingPayout;

        return $self;
    }

    public function withCurrencyISO(string $currencyISO): self
    {
        $self = clone $this;
        $self['currencyISO'] = $currencyISO;

        return $self;
    }

    public function withExpiredReferrals(int $expiredReferrals): self
    {
        $self = clone $this;
        $self['expiredReferrals'] = $expiredReferrals;

        return $self;
    }

    public function withImpressions(int $impressions): self
    {
        $self = clone $this;
        $self['impressions'] = $impressions;

        return $self;
    }

    public function withInvitesSent(int $invitesSent): self
    {
        $self = clone $this;
        $self['invitesSent'] = $invitesSent;

        return $self;
    }

    public function withLeads(int $leads): self
    {
        $self = clone $this;
        $self['leads'] = $leads;

        return $self;
    }

    public function withMonthlyReferrals(int $monthlyReferrals): self
    {
        $self = clone $this;
        $self['monthlyReferrals'] = $monthlyReferrals;

        return $self;
    }

    public function withPendingRewards(int $pendingRewards): self
    {
        $self = clone $this;
        $self['pendingRewards'] = $pendingRewards;

        return $self;
    }

    /**
     * Affiliate only. Revenue attributed to this participant's referrals, in minor currency units.
     */
    public function withReferralRevenue(int $referralRevenue): self
    {
        $self = clone $this;
        $self['referralRevenue'] = $referralRevenue;

        return $self;
    }

    public function withReferrals(int $referrals): self
    {
        $self = clone $this;
        $self['referrals'] = $referrals;

        return $self;
    }

    public function withRewardsEarned(int $rewardsEarned): self
    {
        $self = clone $this;
        $self['rewardsEarned'] = $rewardsEarned;

        return $self;
    }

    /**
     * Affiliate only. Total commissions earned, in minor currency units.
     */
    public function withTotalCommissions(int $totalCommissions): self
    {
        $self = clone $this;
        $self['totalCommissions'] = $totalCommissions;

        return $self;
    }

    /**
     * Affiliate only. Total paid out, in minor currency units.
     */
    public function withTotalPaidOut(int $totalPaidOut): self
    {
        $self = clone $this;
        $self['totalPaidOut'] = $totalPaidOut;

        return $self;
    }

    public function withUniqueImpressions(int $uniqueImpressions): self
    {
        $self = clone $this;
        $self['uniqueImpressions'] = $uniqueImpressions;

        return $self;
    }

    /**
     * Affiliate only. Approved commissions ready to pay, in minor currency units.
     */
    public function withUpcomingPayout(int $upcomingPayout): self
    {
        $self = clone $this;
        $self['upcomingPayout'] = $upcomingPayout;

        return $self;
    }
}
