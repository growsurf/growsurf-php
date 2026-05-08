<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignListLeaderboardParams;

/**
 * Leaderboard ordering mode.
 */
enum LeaderboardType: string
{
    case ALL_TIME = 'ALL_TIME';

    case CURRENT_MONTH = 'CURRENT_MONTH';

    case PREV_MONTH = 'PREV_MONTH';

    case TOTAL_IMPRESSION_COUNT = 'TOTAL_IMPRESSION_COUNT';

    case UNIQUE_IMPRESSION_COUNT = 'UNIQUE_IMPRESSION_COUNT';

    case BY_COMMISSIONS = 'BY_COMMISSIONS';

    case BY_REVENUE = 'BY_REVENUE';

    case BY_REFERRALS = 'BY_REFERRALS';

    case BY_LEADS = 'BY_LEADS';
}
