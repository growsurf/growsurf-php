<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignEngagementAnalytics;

use Growsurf\AnalyticsAvailability;
use Growsurf\AnalyticsUnavailableReason;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

final class ParticipantEngagementPreviousPeriod implements BaseModel
{
    /** @use SdkModel<array<string, mixed>> */
    use SdkModel;

    #[Required(enum: AnalyticsAvailability::class)]
    public string $state;

    #[Required(enum: AnalyticsUnavailableReason::class, nullable: true)]
    public ?string $reason;

    #[Required(nullable: true)]
    public ?ParticipantEngagementTotals $totals;

    public function __construct()
    {
        $this->initialize();
    }
}
