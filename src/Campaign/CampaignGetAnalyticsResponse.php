<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Campaign\CampaignGetAnalyticsResponse\Analytics;
use Growsurf\Campaign\CampaignGetAnalyticsResponse\PreviousPeriod;
use Growsurf\Campaign\CampaignGetAnalyticsResponse\Rates;
use Growsurf\Campaign\CampaignGetAnalyticsResponse\Series;
use Growsurf\Campaign\CampaignGetAnalyticsResponse\StatusCounts;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type AnalyticsShape from \Growsurf\Campaign\CampaignGetAnalyticsResponse\Analytics
 * @phpstan-import-type PreviousPeriodShape from \Growsurf\Campaign\CampaignGetAnalyticsResponse\PreviousPeriod
 * @phpstan-import-type RatesShape from \Growsurf\Campaign\CampaignGetAnalyticsResponse\Rates
 * @phpstan-import-type SeriesShape from \Growsurf\Campaign\CampaignGetAnalyticsResponse\Series
 * @phpstan-import-type StatusCountsShape from \Growsurf\Campaign\CampaignGetAnalyticsResponse\StatusCounts
 *
 * @phpstan-type CampaignGetAnalyticsResponseShape = array{
 *   analytics: Analytics|AnalyticsShape,
 *   endDate: int,
 *   startDate: int,
 *   previousPeriod?: null|PreviousPeriod|PreviousPeriodShape,
 *   rates?: null|Rates|RatesShape,
 *   series?: list<Series|SeriesShape>|null,
 *   statusCounts?: null|StatusCounts|StatusCountsShape,
 * }
 */
final class CampaignGetAnalyticsResponse implements BaseModel
{
    /** @use SdkModel<CampaignGetAnalyticsResponseShape> */
    use SdkModel;

    #[Required]
    public Analytics $analytics;

    #[Required]
    public int $endDate;

    #[Required]
    public int $startDate;

    /**
     * Present only when `interval` is `day`, `week`, or `month`. Per-period totals, ascending.
     *
     * @var list<Series>|null $series
     */
    #[Optional(list: Series::class)]
    public ?array $series;

    /**
     * Present only when `include` contains `previousPeriod`.
     */
    #[Optional]
    public ?PreviousPeriod $previousPeriod;

    /**
     * Present only when `include` contains `rates`.
     */
    #[Optional]
    public ?Rates $rates;

    /**
     * Present only when `include` contains `statusCounts`.
     */
    #[Optional]
    public ?StatusCounts $statusCounts;

    /**
     * `new CampaignGetAnalyticsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CampaignGetAnalyticsResponse::with(analytics: ..., endDate: ..., startDate: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CampaignGetAnalyticsResponse)
     *   ->withAnalytics(...)
     *   ->withEndDate(...)
     *   ->withStartDate(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Analytics|AnalyticsShape $analytics
     * @param PreviousPeriod|PreviousPeriodShape|null $previousPeriod
     * @param Rates|RatesShape|null $rates
     * @param list<Series|SeriesShape>|null $series
     * @param StatusCounts|StatusCountsShape|null $statusCounts
     */
    public static function with(
        Analytics|array $analytics,
        int $endDate,
        int $startDate,
        PreviousPeriod|array|null $previousPeriod = null,
        Rates|array|null $rates = null,
        ?array $series = null,
        StatusCounts|array|null $statusCounts = null,
    ): self {
        $self = new self;

        $self['analytics'] = $analytics;
        $self['endDate'] = $endDate;
        $self['startDate'] = $startDate;

        null !== $previousPeriod && $self['previousPeriod'] = $previousPeriod;
        null !== $rates && $self['rates'] = $rates;
        null !== $series && $self['series'] = $series;
        null !== $statusCounts && $self['statusCounts'] = $statusCounts;

        return $self;
    }

    /**
     * @param Analytics|AnalyticsShape $analytics
     */
    public function withAnalytics(Analytics|array $analytics): self
    {
        $self = clone $this;
        $self['analytics'] = $analytics;

        return $self;
    }

    public function withEndDate(int $endDate): self
    {
        $self = clone $this;
        $self['endDate'] = $endDate;

        return $self;
    }

    public function withStartDate(int $startDate): self
    {
        $self = clone $this;
        $self['startDate'] = $startDate;

        return $self;
    }

    /**
     * Present only when `interval` is `day`, `week`, or `month`. Per-period totals, ascending.
     *
     * @param list<Series|SeriesShape> $series
     */
    public function withSeries(array $series): self
    {
        $self = clone $this;
        $self['series'] = $series;

        return $self;
    }

    /**
     * Present only when `include` contains `previousPeriod`.
     *
     * @param PreviousPeriod|PreviousPeriodShape $previousPeriod
     */
    public function withPreviousPeriod(
        PreviousPeriod|array $previousPeriod
    ): self {
        $self = clone $this;
        $self['previousPeriod'] = $previousPeriod;

        return $self;
    }

    /**
     * Present only when `include` contains `rates`.
     *
     * @param Rates|RatesShape $rates
     */
    public function withRates(Rates|array $rates): self
    {
        $self = clone $this;
        $self['rates'] = $rates;

        return $self;
    }

    /**
     * Present only when `include` contains `statusCounts`.
     *
     * @param StatusCounts|StatusCountsShape $statusCounts
     */
    public function withStatusCounts(StatusCounts|array $statusCounts): self
    {
        $self = clone $this;
        $self['statusCounts'] = $statusCounts;

        return $self;
    }
}
