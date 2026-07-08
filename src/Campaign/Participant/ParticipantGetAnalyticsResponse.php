<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Campaign\Participant\ParticipantGetAnalyticsResponse\Analytics;
use Growsurf\Campaign\Participant\ParticipantGetAnalyticsResponse\Ranks;
use Growsurf\Campaign\Participant\ParticipantGetAnalyticsResponse\Series;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type AnalyticsShape from \Growsurf\Campaign\Participant\ParticipantGetAnalyticsResponse\Analytics
 * @phpstan-import-type RanksShape from \Growsurf\Campaign\Participant\ParticipantGetAnalyticsResponse\Ranks
 * @phpstan-import-type SeriesShape from \Growsurf\Campaign\Participant\ParticipantGetAnalyticsResponse\Series
 *
 * @phpstan-type ParticipantGetAnalyticsResponseShape = array{
 *   analytics: Analytics|AnalyticsShape,
 *   ranks: Ranks|RanksShape,
 *   shareCount: array<string,int>,
 *   endDate?: int|null,
 *   series?: list<Series|SeriesShape>|null,
 *   startDate?: int|null,
 * }
 */
final class ParticipantGetAnalyticsResponse implements BaseModel
{
    /** @use SdkModel<ParticipantGetAnalyticsResponseShape> */
    use SdkModel;

    #[Required]
    public Analytics $analytics;

    #[Required]
    public Ranks $ranks;

    /**
     * Per-channel share counts (e.g. `email`, `facebook`, `twitter`, ...).
     *
     * @var array<string,int> $shareCount
     */
    #[Required(map: 'int')]
    public array $shareCount;

    /**
     * Present only with `include=series`. Window end (Unix ms).
     */
    #[Optional]
    public ?int $endDate;

    /**
     * Present only when `include=series`. This participant's own referral-link activity per period (ascending), windowed by `days`/`startDate`/`endDate` and bucketed by `interval`.
     *
     * @var list<Series>|null $series
     */
    #[Optional(list: Series::class)]
    public ?array $series;

    /**
     * Present only with `include=series`. Window start (Unix ms).
     */
    #[Optional]
    public ?int $startDate;

    /**
     * `new ParticipantGetAnalyticsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantGetAnalyticsResponse::with(
     *   analytics: ...,
     *   ranks: ...,
     *   shareCount: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantGetAnalyticsResponse)
     *   ->withAnalytics(...)
     *   ->withRanks(...)
     *   ->withShareCount(...)
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
     * @param Ranks|RanksShape $ranks
     * @param array<string,int> $shareCount
     * @param list<Series|SeriesShape>|null $series
     */
    public static function with(
        Analytics|array $analytics,
        Ranks|array $ranks,
        array $shareCount,
        ?int $endDate = null,
        ?array $series = null,
        ?int $startDate = null,
    ): self {
        $self = new self;

        $self['analytics'] = $analytics;
        $self['ranks'] = $ranks;
        $self['shareCount'] = $shareCount;

        null !== $endDate && $self['endDate'] = $endDate;
        null !== $series && $self['series'] = $series;
        null !== $startDate && $self['startDate'] = $startDate;

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

    /**
     * @param Ranks|RanksShape $ranks
     */
    public function withRanks(Ranks|array $ranks): self
    {
        $self = clone $this;
        $self['ranks'] = $ranks;

        return $self;
    }

    /**
     * Per-channel share counts (e.g. `email`, `facebook`, `twitter`, ...).
     *
     * @param array<string,int> $shareCount
     */
    public function withShareCount(array $shareCount): self
    {
        $self = clone $this;
        $self['shareCount'] = $shareCount;

        return $self;
    }

    /**
     * Present only with `include=series`. Window end (Unix ms).
     */
    public function withEndDate(int $endDate): self
    {
        $self = clone $this;
        $self['endDate'] = $endDate;

        return $self;
    }

    /**
     * Present only when `include=series`. This participant's own referral-link activity per period (ascending), windowed by `days`/`startDate`/`endDate` and bucketed by `interval`.
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
     * Present only with `include=series`. Window start (Unix ms).
     */
    public function withStartDate(int $startDate): self
    {
        $self = clone $this;
        $self['startDate'] = $startDate;

        return $self;
    }
}
