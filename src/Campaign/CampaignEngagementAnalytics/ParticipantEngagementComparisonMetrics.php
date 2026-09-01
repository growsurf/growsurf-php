<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignEngagementAnalytics;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

final class ParticipantEngagementComparisonMetrics implements BaseModel
{
    /** @use SdkModel<array<string, mixed>> */
    use SdkModel;

    #[Optional]
    public ?ParticipantEngagementMetric $activeParticipants;

    #[Optional]
    public ?ParticipantEngagementMetric $sharingParticipants;

    #[Optional]
    public ?ParticipantEngagementMetric $repeatActiveParticipants;

    #[Optional]
    public ?ParticipantEngagementMetric $repeatSharingParticipants;

    #[Optional]
    public ?ParticipantEngagementMetric $portalViews;

    #[Optional]
    public ?ParticipantEngagementMetric $shareActions;

    public function __construct()
    {
        $this->initialize();
    }
}
