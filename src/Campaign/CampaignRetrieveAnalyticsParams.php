<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Campaign\CampaignRetrieveAnalyticsParams\Interval;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Retrieves analytics for a program. Pass `interval` to also get a time-series (`series`) alongside the totals, and `include` to add previous-period totals, status breakdowns, or derived rates — useful for detecting trends over time.
 *
 * @see Growsurf\Services\CampaignService::retrieveAnalytics()
 *
 * @phpstan-type CampaignRetrieveAnalyticsParamsShape = array{
 *   days?: int|null,
 *   endDate?: int|null,
 *   include?: string|null,
 *   interval?: null|Interval|value-of<Interval>,
 *   startDate?: int|null,
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
     * Comma-separated list of optional enrichments (opt-in to keep the default response lean): `previousPeriod` adds totals for the equal-length window immediately before the requested one; `statusCounts` adds reward (and, for affiliate programs, affiliate/commission/payout) status breakdowns; `rates` adds derived referral rates.
     */
    #[Optional]
    public ?string $include;

    /**
     * When set to `day`, `week`, or `month`, the response also includes a `series` array with per-period totals. Defaults to `total` (no series).
     *
     * @var value-of<Interval>|null $interval
     */
    #[Optional(enum: Interval::class)]
    public ?string $interval;

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
     *
     * @param Interval|value-of<Interval>|null $interval
     */
    public static function with(
        ?int $days = null,
        ?int $endDate = null,
        ?string $include = null,
        Interval|string|null $interval = null,
        ?int $startDate = null,
    ): self {
        $self = new self;

        null !== $days && $self['days'] = $days;
        null !== $endDate && $self['endDate'] = $endDate;
        null !== $include && $self['include'] = $include;
        null !== $interval && $self['interval'] = $interval;
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
     * Comma-separated list of optional enrichments (opt-in to keep the default response lean): `previousPeriod` adds totals for the equal-length window immediately before the requested one; `statusCounts` adds reward (and, for affiliate programs, affiliate/commission/payout) status breakdowns; `rates` adds derived referral rates.
     */
    public function withInclude(string $include): self
    {
        $self = clone $this;
        $self['include'] = $include;

        return $self;
    }

    /**
     * When set to `day`, `week`, or `month`, the response also includes a `series` array with per-period totals. Defaults to `total` (no series).
     *
     * @param Interval|value-of<Interval> $interval
     */
    public function withInterval(Interval|string $interval): self
    {
        $self = clone $this;
        $self['interval'] = $interval;

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
