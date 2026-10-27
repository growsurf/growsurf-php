<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignCreateParams;

/**
 * What the program is for, which seeds the share buttons and the starter rewards that suit that audience. Set it when you create the program; it is not accepted on update.
 *
 * Programs whose participants refer other businesses (`CUSTOMERS`, `USERS`, `B2B_SAAS_SELF_SERVICE`, `B2B_SAAS_ENTERPRISE`, `HEALTHCARE_PROVIDERS`) start with the LinkedIn share button visible. Consumer, financial, education, insurance, telehealth, newsletter, and waitlist programs (`B2C_SUBSCRIPTIONS`, `FINANCIAL_SERVICES`, `ONLINE_EDUCATION`, `INSURANCE`, `ONLINE_INSURANCE`, `TELEHEALTH`, `SUBSCRIBERS`, `WAITLIST`) start with it hidden. On a referral program, each goal also sets the rest of its share buttons to suit that audience — a telehealth program keeps the public feeds off, a consumer subscription turns Pinterest and Reddit on. An affiliate program has its own share defaults, so only the LinkedIn default above applies to one. Omit `goal` and every share button keeps its standard default. Change any of it afterward with `PATCH /campaign/{id}/design`.
 *
 * When you create a referral program without `rewards`, the goal also decides the starter rewards: most goals get one double-sided reward, `HEALTHCARE_PROVIDERS` gets a single-sided reward, `SUBSCRIBERS` gets a four-step milestone ladder, and `WAITLIST` gets a leaderboard. Every starter reward arrives switched off with a placeholder name, so the program awards nothing until you set the amount and turn one on.
 *
 * `TELEHEALTH` is for consumer telehealth and wellness subscriptions, where patients refer friends. `HEALTHCARE_PROVIDERS` is for provider networks and clinician-facing products, where practices refer peer practices. A `TELEHEALTH` program also starts with `useGrowSurfHostedLinks` on, so each referral link is a GrowSurf-hosted link; turn it off with `PATCH /campaign/{id}/installation`. It also starts with `offerPageRedirectSeconds` set to `10` and with starter offer-page content (`referredExperience.offerPageDescription` and `offerPageSteps`). Values you send in the create request are kept. `INSURANCE` replaces `ONLINE_INSURANCE`, which is still accepted and behaves identically.
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
