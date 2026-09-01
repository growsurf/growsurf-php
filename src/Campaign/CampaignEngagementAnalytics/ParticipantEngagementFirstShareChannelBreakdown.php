<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignEngagementAnalytics;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

final class ParticipantEngagementFirstShareChannelBreakdown implements BaseModel
{
    /** @use SdkModel<array<string, mixed>> */
    use SdkModel;

    #[Required]
    public string $key;

    #[Required]
    public int $sharingParticipants;

    public function __construct()
    {
        $this->initialize();
    }
}
