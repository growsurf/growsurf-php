<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignCreateParams;

/**
 * What the program is for, which seeds the share buttons and the starter rewards that suit that audience. Programs whose participants refer other businesses (`CUSTOMERS`, `USERS`, `B2B_SAAS_SELF_SERVICE`, `B2B_SAAS_ENTERPRISE`, `HEALTHCARE_PROVIDERS`) start with the LinkedIn share button visible; consumer, financial, education, insurance, telehealth, newsletter, and waitlist programs (`B2C_SUBSCRIPTIONS`, `FINANCIAL_SERVICES`, `ONLINE_EDUCATION`, `INSURANCE`, `ONLINE_INSURANCE`, `TELEHEALTH`, `SUBSCRIBERS`, `WAITLIST`) start with it hidden, and each goal also sets the rest of its share buttons to suit that audience. When you create a program without `rewards`, the goal also decides the starter rewards: most goals get one double-sided reward, `HEALTHCARE_PROVIDERS` gets a single-sided reward, `SUBSCRIBERS` gets a four-step milestone ladder, and
 * `WAITLIST` gets a leaderboard. Every one arrives switched off with a placeholder name, so the program awards nothing until you set the amount and turn one on. `TELEHEALTH` is for consumer telehealth and wellness subscriptions; `HEALTHCARE_PROVIDERS` is for provider networks and clinician-facing products. `INSURANCE` replaces `ONLINE_INSURANCE`, which is still accepted. Omit it and every share button keeps its standard default. Set only when the program is created; it is not accepted on update.
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

    case INSURANCE = 'INSURANCE';

    case ONLINE_INSURANCE = 'ONLINE_INSURANCE';

    case TELEHEALTH = 'TELEHEALTH';

    case HEALTHCARE_PROVIDERS = 'HEALTHCARE_PROVIDERS';
}
