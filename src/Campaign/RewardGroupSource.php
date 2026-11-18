<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

/**
 * How a participant got into their group. `MANUAL` — a move (a `PARTICIPANT` rule, Update participant, bulk move, or the dashboard), including a move to Default. `LINK` — the group's signup link. `EMAIL` — an `EMAIL` rule. `DOMAIN` — a `DOMAIN` rule.
 */
enum RewardGroupSource: string
{
    case MANUAL = 'MANUAL';

    case LINK = 'LINK';

    case EMAIL = 'EMAIL';

    case DOMAIN = 'DOMAIN';
}
