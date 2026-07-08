<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignGetAnalyticsResponse;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Derived referral rates, each a ratio in the range 0–1 (0 when its denominator is 0). Present only when `include` contains `rates`.
 *
 * @phpstan-type RatesShape = array{
 *   participationRate?: float|null,
 *   referralConversionRate?: float|null,
 *   sharesPerParticipant?: float|null,
 * }
 */
final class Rates implements BaseModel
{
    /** @use SdkModel<RatesShape> */
    use SdkModel;

    /**
     * `participants` divided by `uniqueImpressions`.
     */
    #[Optional]
    public ?float $participationRate;

    /**
     * `referrals` divided by `uniqueImpressions`.
     */
    #[Optional]
    public ?float $referralConversionRate;

    /**
     * Total shares across all channels divided by `participants`.
     */
    #[Optional]
    public ?float $sharesPerParticipant;

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
        ?float $participationRate = null,
        ?float $referralConversionRate = null,
        ?float $sharesPerParticipant = null,
    ): self {
        $self = new self;

        null !== $participationRate && $self['participationRate'] = $participationRate;
        null !== $referralConversionRate && $self['referralConversionRate'] = $referralConversionRate;
        null !== $sharesPerParticipant && $self['sharesPerParticipant'] = $sharesPerParticipant;

        return $self;
    }

    /**
     * `participants` divided by `uniqueImpressions`.
     */
    public function withParticipationRate(float $participationRate): self
    {
        $self = clone $this;
        $self['participationRate'] = $participationRate;

        return $self;
    }

    /**
     * `referrals` divided by `uniqueImpressions`.
     */
    public function withReferralConversionRate(
        float $referralConversionRate
    ): self {
        $self = clone $this;
        $self['referralConversionRate'] = $referralConversionRate;

        return $self;
    }

    /**
     * Total shares across all channels divided by `participants`.
     */
    public function withSharesPerParticipant(float $sharesPerParticipant): self
    {
        $self = clone $this;
        $self['sharesPerParticipant'] = $sharesPerParticipant;

        return $self;
    }
}
