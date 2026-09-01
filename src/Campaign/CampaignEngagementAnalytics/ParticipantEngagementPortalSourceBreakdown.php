<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignEngagementAnalytics;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

final class ParticipantEngagementPortalSourceBreakdown implements BaseModel
{
    /** @use SdkModel<array<string, mixed>> */
    use SdkModel;

    #[Required(enum: PortalViewSource::class)]
    public string $key;

    #[Required]
    public int $activeParticipants;

    #[Required]
    public int $portalViews;

    public function __construct()
    {
        $this->initialize();
    }
}
