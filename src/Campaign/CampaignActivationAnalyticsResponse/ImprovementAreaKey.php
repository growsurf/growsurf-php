<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignActivationAnalyticsResponse;

enum ImprovementAreaKey: string
{
    case PORTAL_ACCESS = 'PORTAL_ACCESS';

    case SHARING_EXPERIENCE = 'SHARING_EXPERIENCE';

    case SHARE_EFFECTIVENESS = 'SHARE_EFFECTIVENESS';

    case VISITOR_SIGNUP = 'VISITOR_SIGNUP';

    case ATTRIBUTION_AND_QUALIFICATION = 'ATTRIBUTION_AND_QUALIFICATION';
}
