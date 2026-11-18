<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

/**
 * `PARTICIPANT` — an existing participant ID; the participant moves in now. `EMAIL` — an exact email address. `DOMAIN` — a company domain such as `hooli.com`, which also matches its subdomains. Email and domain rules place new signups and affiliate approvals.
 */
enum RewardGroupRuleType: string
{
    case PARTICIPANT = 'PARTICIPANT';

    case EMAIL = 'EMAIL';

    case DOMAIN = 'DOMAIN';
}
