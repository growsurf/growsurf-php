<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Tax valuation settings for a reward. Only relevant when the program collects tax documentation.
 *
 * @phpstan-type RewardTaxValuationShape = array{
 *   fairMarketValueUSD?: float|null, isTaxReportable?: bool|null
 * }
 */
final class RewardTaxValuation implements BaseModel
{
    /** @use SdkModel<RewardTaxValuationShape> */
    use SdkModel;

    /**
     * Manual fair-market value in USD (major units) used as the fallback when the reward value cannot be resolved automatically. `null` = no manual value.
     */
    #[Optional(nullable: true)]
    public ?float $fairMarketValueUSD;

    /**
     * Whether the reward's value counts toward 1099 thresholds/totals. `null` = use the smart default for the reward's source.
     */
    #[Optional(nullable: true)]
    public ?bool $isTaxReportable;

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
        ?float $fairMarketValueUSD = null,
        ?bool $isTaxReportable = null
    ): self {
        $self = new self;

        null !== $fairMarketValueUSD && $self['fairMarketValueUSD'] = $fairMarketValueUSD;
        null !== $isTaxReportable && $self['isTaxReportable'] = $isTaxReportable;

        return $self;
    }

    /**
     * Manual fair-market value in USD (major units) used as the fallback when the reward value cannot be resolved automatically. `null` = no manual value.
     */
    public function withFairMarketValueUSD(?float $fairMarketValueUSD): self
    {
        $self = clone $this;
        $self['fairMarketValueUSD'] = $fairMarketValueUSD;

        return $self;
    }

    /**
     * Whether the reward's value counts toward 1099 thresholds/totals. `null` = use the smart default for the reward's source.
     */
    public function withIsTaxReportable(?bool $isTaxReportable): self
    {
        $self = clone $this;
        $self['isTaxReportable'] = $isTaxReportable;

        return $self;
    }
}
