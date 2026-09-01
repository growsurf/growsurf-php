<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignEngagementAnalytics;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

final class ParticipantEngagementPlatformBreakdown implements BaseModel
{
    /** @use SdkModel<array<string, mixed>> */
    use SdkModel;

    #[Required(enum: BreakdownPlatform::class)]
    public string $key;

    #[Required]
    public int $activeParticipants;

    #[Required]
    public int $sharingParticipants;

    #[Required]
    public int $portalViews;

    #[Required]
    public int $shareActions;

    public function __construct()
    {
        $this->initialize();
    }
}
