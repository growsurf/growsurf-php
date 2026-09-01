<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignEngagementAnalytics;

use Growsurf\AnalyticsAvailability;
use Growsurf\AnalyticsUnavailableReason;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

final class ParticipantEngagementMetric implements BaseModel
{
    /** @use SdkModel<array<string, mixed>> */
    use SdkModel;

    #[Required(enum: AnalyticsAvailability::class)]
    public string $state;

    #[Required(nullable: true)]
    public ?float $value;

    #[Required(enum: AnalyticsUnavailableReason::class, nullable: true)]
    public ?string $reason;

    #[Optional]
    public ?float $delta;

    public function __construct()
    {
        $this->initialize();
    }
}
