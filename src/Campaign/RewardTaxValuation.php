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
 *   fairMarketValueUSD?: float|null, taxCharacter?: 'NONEMPLOYEE_SERVICES'|'PRIZE_OR_AWARD'|'PURCHASE_REBATE'|'OTHER_INCOME'|'REVIEW_REQUIRED'|null
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
     * The reason the recipient earns this reward. `null` inherits the program's confirmed tax treatment for configurable non-commission rewards. Commission rewards always use `NONEMPLOYEE_SERVICES`.
     */
    #[Optional(nullable: true)]
    public ?string $taxCharacter;

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
        ?string $taxCharacter = null
    ): self {
        $self = new self;

        null !== $fairMarketValueUSD && $self['fairMarketValueUSD'] = $fairMarketValueUSD;
        null !== $taxCharacter && $self['taxCharacter'] = $taxCharacter;

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
     * The reason the recipient earns this reward. `null` inherits the program's confirmed tax treatment for configurable non-commission rewards. Commission rewards always use `NONEMPLOYEE_SERVICES`.
     */
    public function withTaxCharacter(?string $taxCharacter): self
    {
        $self = clone $this;
        $self['taxCharacter'] = $taxCharacter;

        return $self;
    }
}
