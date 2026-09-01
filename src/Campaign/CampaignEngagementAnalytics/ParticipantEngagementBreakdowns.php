<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignEngagementAnalytics;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

final class ParticipantEngagementBreakdowns implements BaseModel
{
    /** @use SdkModel<array<string, mixed>> */
    use SdkModel;

    /** @var list<ParticipantEngagementPlatformBreakdown> $platforms */
    #[Required(list: ParticipantEngagementPlatformBreakdown::class)]
    public array $platforms;

    /** @var list<ParticipantEngagementPortalSourceBreakdown> $portalViewSources */
    #[Required(list: ParticipantEngagementPortalSourceBreakdown::class)]
    public array $portalViewSources;

    /** @var list<ParticipantEngagementShareChannelBreakdown> $shareChannels */
    #[Required(list: ParticipantEngagementShareChannelBreakdown::class)]
    public array $shareChannels;

    /** @var list<ParticipantEngagementFirstShareChannelBreakdown> $firstShareChannels */
    #[Required(list: ParticipantEngagementFirstShareChannelBreakdown::class)]
    public array $firstShareChannels;

    public function __construct()
    {
        $this->initialize();
    }
}
