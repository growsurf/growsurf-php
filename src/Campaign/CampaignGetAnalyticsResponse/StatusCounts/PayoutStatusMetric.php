<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignGetAnalyticsResponse\StatusCounts;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Affiliate only. Payout count and amount for a single status. Money amounts are in minor currency units.
 *
 * @phpstan-type PayoutStatusMetricShape = array{
 *   count?: int|null, totalAmount?: int|null
 * }
 */
final class PayoutStatusMetric implements BaseModel
{
    /** @use SdkModel<PayoutStatusMetricShape> */
    use SdkModel;

    #[Optional]
    public ?int $count;

    /**
     * Total payout amount in minor currency units.
     */
    #[Optional]
    public ?int $totalAmount;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?int $count = null, ?int $totalAmount = null): self
    {
        $self = new self;

        null !== $count && $self['count'] = $count;
        null !== $totalAmount && $self['totalAmount'] = $totalAmount;

        return $self;
    }

    public function withCount(int $count): self
    {
        $self = clone $this;
        $self['count'] = $count;

        return $self;
    }

    /**
     * Total payout amount in minor currency units.
     */
    public function withTotalAmount(int $totalAmount): self
    {
        $self = clone $this;
        $self['totalAmount'] = $totalAmount;

        return $self;
    }
}
