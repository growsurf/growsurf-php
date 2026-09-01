<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\AnalyticsAvailability;
use Growsurf\AnalyticsUnavailableReason;
use Growsurf\Campaign\Campaign\Type;
use Growsurf\Campaign\CampaignEngagementAnalytics\Interval;
use Growsurf\Campaign\CampaignEngagementAnalytics\ParticipantEngagementBreakdowns;
use Growsurf\Campaign\CampaignEngagementAnalytics\ParticipantEngagementComparison;
use Growsurf\Campaign\CampaignEngagementAnalytics\ParticipantEngagementPeriod;
use Growsurf\Campaign\CampaignEngagementAnalytics\ParticipantEngagementPlatformFilter;
use Growsurf\Campaign\CampaignEngagementAnalytics\ParticipantEngagementPreviousPeriod;
use Growsurf\Campaign\CampaignEngagementAnalytics\ParticipantEngagementSeriesPoint;
use Growsurf\Campaign\CampaignEngagementAnalytics\ParticipantEngagementTotals;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/** Current participant engagement for the selected program, period, and platform. */
final class CampaignEngagementAnalytics implements BaseModel
{
    /** @use SdkModel<array<string, mixed>> */
    use SdkModel;

    #[Required(nullable: true)]
    public ?int $coverageStartAt;

    #[Required]
    public int $metricContractVersion;

    #[Required(enum: Type::class)]
    public string $programType;

    #[Required]
    public string $timezone;

    #[Required(enum: Interval::class)]
    public string $interval;

    #[Required]
    public ParticipantEngagementPlatformFilter $platform;

    #[Required]
    public ParticipantEngagementPeriod $period;

    #[Required(enum: AnalyticsAvailability::class)]
    public string $state;

    #[Required(enum: AnalyticsUnavailableReason::class, nullable: true)]
    public ?string $reason;

    #[Required]
    public ParticipantEngagementTotals $totals;

    #[Required]
    public ParticipantEngagementPreviousPeriod $previousPeriod;

    #[Required]
    public ParticipantEngagementComparison $comparison;

    /** @var list<ParticipantEngagementSeriesPoint> $series */
    #[Required(list: ParticipantEngagementSeriesPoint::class)]
    public array $series;

    #[Required]
    public ParticipantEngagementBreakdowns $breakdowns;

    public function __construct()
    {
        $this->initialize();
    }
}
