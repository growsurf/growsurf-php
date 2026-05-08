<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Campaign\CampaignGetAnalyticsResponse\Analytics;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type AnalyticsShape from \Growsurf\Campaign\CampaignGetAnalyticsResponse\Analytics
 *
 * @phpstan-type CampaignGetAnalyticsResponseShape = array{
 *   analytics: Analytics|AnalyticsShape, endDate: int, startDate: int
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
     */
    public static function with(
        Analytics|array $analytics,
        int $endDate,
        int $startDate
    ): self {
        $self = new self;

        $self['analytics'] = $analytics;
        $self['endDate'] = $endDate;
        $self['startDate'] = $startDate;

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
}
