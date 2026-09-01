<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Campaign\CampaignRetrieveAnalyticsParams\Interval;
use Growsurf\Campaign\CampaignRetrieveAnalyticsParams\Platform;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Retrieves analytics for a program. Add `engagement` to `include` for covered participant activity. Use `platform` and `timezone` to filter and bound engagement data.
 *
 * @see Growsurf\Services\CampaignService::retrieveAnalytics()
 *
 * @phpstan-type CampaignRetrieveAnalyticsParamsShape = array{
 *   days?: int|null,
 *   endDate?: int|null,
 *   include?: string|null,
 *   interval?: null|Interval|value-of<Interval>,
 *   platform?: null|Platform|value-of<Platform>,
 *   startDate?: int|null,
 *   timezone?: string|null,
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
     * Comma-separated optional data. `engagement` adds covered participant engagement; `previousPeriod`, `statusCounts`, `rates`, and `email` preserve their existing analytics behavior.
     */
    #[Optional]
    public ?string $include;

    /**
     * When set to `day`, `week`, or `month`, the response also includes a `series` array with per-period totals and uses the same bucket size for `engagement.series`. Defaults to `total` (no legacy series); `engagement.series` uses daily buckets when `interval` is `total` or omitted.
     *
     * @var value-of<Interval>|null $interval
     */
    #[Optional(enum: Interval::class)]
    public ?string $interval;

    /** Platform filter for `engagement`. Defaults to `ALL`. */
    #[Optional(enum: Platform::class)]
    public ?string $platform;

    /**
     * Start date of the analytics timeframe as a Unix timestamp in milliseconds. Required if `days` is not set.
     */
    #[Optional]
    public ?int $startDate;

    /** IANA timezone for engagement period boundaries. Defaults to `UTC`. */
    #[Optional]
    public ?string $timezone;

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
     * @param Platform|value-of<Platform>|null $platform
     */
    public static function with(
        ?int $days = null,
        ?int $endDate = null,
        ?string $include = null,
        Interval|string|null $interval = null,
        ?int $startDate = null,
        Platform|string|null $platform = null,
        ?string $timezone = null,
    ): self {
        $self = new self;

        null !== $days && $self['days'] = $days;
        null !== $endDate && $self['endDate'] = $endDate;
        null !== $include && $self['include'] = $include;
        null !== $interval && $self['interval'] = $interval;
        null !== $platform && $self['platform'] = $platform;
        null !== $startDate && $self['startDate'] = $startDate;
        null !== $timezone && $self['timezone'] = $timezone;

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
     * Comma-separated optional data. `engagement` adds covered participant engagement;
     * `previousPeriod`, `statusCounts`, `rates`, and `email` preserve their existing analytics
     * behavior.
     */
    public function withInclude(string $include): self
    {
        $self = clone $this;
        $self['include'] = $include;

        return $self;
    }

    /**
     * When set to `day`, `week`, or `month`, the response also includes a `series` array with per-period totals and uses the same bucket size for `engagement.series`. Defaults to `total` (no legacy series); `engagement.series` uses daily buckets when `interval` is `total` or omitted.
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
     * Platform filter for `engagement`. Defaults to `ALL`.
     *
     * @param Platform|value-of<Platform> $platform
     */
    public function withPlatform(Platform|string $platform): self
    {
        $self = clone $this;
        $self['platform'] = $platform;

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

    /** IANA timezone for engagement period boundaries. Defaults to `UTC`. */
    public function withTimezone(string $timezone): self
    {
        $self = clone $this;
        $self['timezone'] = $timezone;

        return $self;
    }
}
