<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignGetAnalyticsResponse\StatusCounts;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Affiliate only. Commission count and amounts for a single status. Money amounts are in minor currency units.
 *
 * @phpstan-type CommissionStatusMetricShape = array{
 *   count?: int|null, totalAmount?: int|null, totalRevenue?: int|null
 * }
 */
final class CommissionStatusMetric implements BaseModel
{
    /** @use SdkModel<CommissionStatusMetricShape> */
    use SdkModel;

    #[Optional]
    public ?int $count;

    /**
     * Total commission amount in minor currency units.
     */
    #[Optional]
    public ?int $totalAmount;

    /**
     * Total attributed revenue in minor currency units.
     */
    #[Optional]
    public ?int $totalRevenue;

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
        ?int $count = null,
        ?int $totalAmount = null,
        ?int $totalRevenue = null,
    ): self {
        $self = new self;

        null !== $count && $self['count'] = $count;
        null !== $totalAmount && $self['totalAmount'] = $totalAmount;
        null !== $totalRevenue && $self['totalRevenue'] = $totalRevenue;

        return $self;
    }

    public function withCount(int $count): self
    {
        $self = clone $this;
        $self['count'] = $count;

        return $self;
    }

    /**
     * Total commission amount in minor currency units.
     */
    public function withTotalAmount(int $totalAmount): self
    {
        $self = clone $this;
        $self['totalAmount'] = $totalAmount;

        return $self;
    }

    /**
     * Total attributed revenue in minor currency units.
     */
    public function withTotalRevenue(int $totalRevenue): self
    {
        $self = clone $this;
        $self['totalRevenue'] = $totalRevenue;

        return $self;
    }
}
