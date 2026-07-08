<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignGetAnalyticsResponse;

use Growsurf\Campaign\CampaignGetAnalyticsResponse\StatusCounts\CommissionStatus;
use Growsurf\Campaign\CampaignGetAnalyticsResponse\StatusCounts\PayoutStatus;
use Growsurf\Campaign\CampaignGetAnalyticsResponse\StatusCounts\RewardStatus;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Status-count breakdowns. `rewardStatus` is present for every program; `affiliateStatus`, `commissionStatus`, and `payoutStatus` are present only for affiliate programs. Money amounts are in minor units of `currencyISO`.
 *
 * @phpstan-import-type CommissionStatusShape from \Growsurf\Campaign\CampaignGetAnalyticsResponse\StatusCounts\CommissionStatus
 * @phpstan-import-type PayoutStatusShape from \Growsurf\Campaign\CampaignGetAnalyticsResponse\StatusCounts\PayoutStatus
 * @phpstan-import-type RewardStatusShape from \Growsurf\Campaign\CampaignGetAnalyticsResponse\StatusCounts\RewardStatus
 *
 * @phpstan-type StatusCountsShape = array{
 *   affiliateStatus?: array<string,int>|null,
 *   commissionStatus?: null|CommissionStatus|CommissionStatusShape,
 *   currencyISO?: string|null,
 *   payoutStatus?: null|PayoutStatus|PayoutStatusShape,
 *   rewardStatus?: null|RewardStatus|RewardStatusShape,
 * }
 */
final class StatusCounts implements BaseModel
{
    /** @use SdkModel<StatusCountsShape> */
    use SdkModel;

    /**
     * Affiliate only. Participant counts keyed by affiliate status.
     *
     * @var array<string,int>|null $affiliateStatus
     */
    #[Optional(map: 'int')]
    public ?array $affiliateStatus;

    #[Optional]
    public ?CommissionStatus $commissionStatus;

    #[Optional]
    public ?string $currencyISO;

    #[Optional]
    public ?PayoutStatus $payoutStatus;

    #[Optional]
    public ?RewardStatus $rewardStatus;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string,int>|null $affiliateStatus
     * @param CommissionStatus|CommissionStatusShape|null $commissionStatus
     * @param PayoutStatus|PayoutStatusShape|null $payoutStatus
     * @param RewardStatus|RewardStatusShape|null $rewardStatus
     */
    public static function with(
        ?array $affiliateStatus = null,
        CommissionStatus|array|null $commissionStatus = null,
        ?string $currencyISO = null,
        PayoutStatus|array|null $payoutStatus = null,
        RewardStatus|array|null $rewardStatus = null,
    ): self {
        $self = new self;

        null !== $affiliateStatus && $self['affiliateStatus'] = $affiliateStatus;
        null !== $commissionStatus && $self['commissionStatus'] = $commissionStatus;
        null !== $currencyISO && $self['currencyISO'] = $currencyISO;
        null !== $payoutStatus && $self['payoutStatus'] = $payoutStatus;
        null !== $rewardStatus && $self['rewardStatus'] = $rewardStatus;

        return $self;
    }

    /**
     * Affiliate only. Participant counts keyed by affiliate status.
     *
     * @param array<string,int> $affiliateStatus
     */
    public function withAffiliateStatus(array $affiliateStatus): self
    {
        $self = clone $this;
        $self['affiliateStatus'] = $affiliateStatus;

        return $self;
    }

    /**
     * @param CommissionStatus|CommissionStatusShape $commissionStatus
     */
    public function withCommissionStatus(
        CommissionStatus|array $commissionStatus
    ): self {
        $self = clone $this;
        $self['commissionStatus'] = $commissionStatus;

        return $self;
    }

    public function withCurrencyISO(string $currencyISO): self
    {
        $self = clone $this;
        $self['currencyISO'] = $currencyISO;

        return $self;
    }

    /**
     * @param PayoutStatus|PayoutStatusShape $payoutStatus
     */
    public function withPayoutStatus(PayoutStatus|array $payoutStatus): self
    {
        $self = clone $this;
        $self['payoutStatus'] = $payoutStatus;

        return $self;
    }

    /**
     * @param RewardStatus|RewardStatusShape $rewardStatus
     */
    public function withRewardStatus(RewardStatus|array $rewardStatus): self
    {
        $self = clone $this;
        $self['rewardStatus'] = $rewardStatus;

        return $self;
    }
}
