<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignActivationAnalyticsResponse;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

final class ActivationStageCounts implements BaseModel
{
    /** @use SdkModel<array<string, mixed>> */
    use SdkModel;

    #[Required('ELIGIBLE')]
    public int $eligible;

    #[Required('PORTAL_VIEWED')]
    public int $portalViewed;

    #[Required('SHARE_ACTION')]
    public int $shareAction;

    #[Required('UNIQUE_REFERRAL_VISIT')]
    public int $uniqueReferralVisit;

    #[Required('LEAD')]
    public int $lead;

    #[Required('CREDITED_REFERRAL')]
    public int $creditedReferral;

    public function __construct()
    {
        $this->initialize();
    }
}
