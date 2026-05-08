<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Retrieves analytics for a program.
 *
 * @see Growsurf\Services\CampaignService::retrieveAnalytics()
 *
 * @phpstan-type CampaignRetrieveAnalyticsParamsShape = array{
 *   days?: int|null, endDate?: int|null, startDate?: int|null
 * }
 */
final class CampaignRetrieveAnalyticsParams implements BaseModel
{
    /** @use SdkModel<CampaignRetrieveAnalyticsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Last number of days to retrieve analytics for. Defaults to 365. Maximum 1825.
     */
    #[Optional]
    public ?int $days;

    /**
     * End date of the analytics timeframe as a Unix timestamp in milliseconds. Required if `days` is not set.
     */
    #[Optional]
    public ?int $endDate;

    /**
     * Start date of the analytics timeframe as a Unix timestamp in milliseconds. Required if `days` is not set.
     */
    #[Optional]
    public ?int $startDate;

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
        ?int $days = null,
        ?int $endDate = null,
        ?int $startDate = null
    ): self {
        $self = new self;

        null !== $days && $self['days'] = $days;
        null !== $endDate && $self['endDate'] = $endDate;
        null !== $startDate && $self['startDate'] = $startDate;

        return $self;
    }

    /**
     * Last number of days to retrieve analytics for. Defaults to 365. Maximum 1825.
     */
    public function withDays(int $days): self
    {
        $self = clone $this;
        $self['days'] = $days;

        return $self;
    }

    /**
     * End date of the analytics timeframe as a Unix timestamp in milliseconds. Required if `days` is not set.
     */
    public function withEndDate(int $endDate): self
    {
        $self = clone $this;
        $self['endDate'] = $endDate;

        return $self;
    }

    /**
     * Start date of the analytics timeframe as a Unix timestamp in milliseconds. Required if `days` is not set.
     */
    public function withStartDate(int $startDate): self
    {
        $self = clone $this;
        $self['startDate'] = $startDate;

        return $self;
    }
}
