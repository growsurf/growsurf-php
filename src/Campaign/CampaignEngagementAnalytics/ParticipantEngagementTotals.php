<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignEngagementAnalytics;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

final class ParticipantEngagementTotals implements BaseModel
{
    /** @use SdkModel<array<string, mixed>> */
    use SdkModel;

    #[Required]
    public ParticipantEngagementMetric $activeParticipants;

    #[Required]
    public ParticipantEngagementMetric $sharingParticipants;

    #[Required]
    public ParticipantEngagementMetric $sharingRate;

    #[Required]
    public ParticipantEngagementMetric $repeatActiveParticipants;

    #[Required]
    public ParticipantEngagementMetric $repeatSharingParticipants;

    #[Required]
    public ParticipantEngagementMetric $retainedActiveParticipants;

    #[Required]
    public ParticipantEngagementMetric $portalViews;

    #[Required]
    public ParticipantEngagementMetric $shareActions;

    public function __construct()
    {
        $this->initialize();
    }
}
