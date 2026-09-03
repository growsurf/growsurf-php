<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignCreateParams;

/**
 * What the program is for, which seeds share settings that suit that audience. Programs selling to businesses (`CUSTOMERS`, `USERS`, `B2B_SAAS_SELF_SERVICE`, `B2B_SAAS_ENTERPRISE`) start with the LinkedIn share button visible; consumer, financial, education, insurance, newsletter, and waitlist programs (`B2C_SUBSCRIPTIONS`, `FINANCIAL_SERVICES`, `ONLINE_EDUCATION`, `ONLINE_INSURANCE`, `SUBSCRIBERS`, `WAITLIST`) start with it hidden. Omit it and every share button keeps its standard default. Set only when the program is created; it is not accepted on update.
 */
enum Goal: string
{
    case CUSTOMERS = 'CUSTOMERS';

    case USERS = 'USERS';

    case SUBSCRIBERS = 'SUBSCRIBERS';

    case WAITLIST = 'WAITLIST';

    case B2B_SAAS_SELF_SERVICE = 'B2B_SAAS_SELF_SERVICE';

    case B2B_SAAS_ENTERPRISE = 'B2B_SAAS_ENTERPRISE';

    case B2C_SUBSCRIPTIONS = 'B2C_SUBSCRIPTIONS';

    case FINANCIAL_SERVICES = 'FINANCIAL_SERVICES';

    case ONLINE_EDUCATION = 'ONLINE_EDUCATION';

    case ONLINE_INSURANCE = 'ONLINE_INSURANCE';
}
