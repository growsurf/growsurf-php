<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignEngagementAnalytics;

use Growsurf\AnalyticsAvailability;
use Growsurf\Campaign\CampaignRetrieveAnalyticsParams\Platform;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

final class ParticipantEngagementPlatformFilter implements BaseModel
{
    /** @use SdkModel<array<string, mixed>> */
    use SdkModel;

    #[Required(enum: Platform::class)]
    public string $requested;

    #[Required(enum: Platform::class)]
    public string $applied;

    #[Required(enum: AnalyticsAvailability::class)]
    public string $state;

    public function __construct()
    {
        $this->initialize();
    }
}
