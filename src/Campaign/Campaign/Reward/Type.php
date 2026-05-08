<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Campaign\Reward;

enum Type: string
{
    case SINGLE_SIDED = 'SINGLE_SIDED';

    case DOUBLE_SIDED = 'DOUBLE_SIDED';

    case MILESTONE = 'MILESTONE';

    case LEADERBOARD = 'LEADERBOARD';

    case AFFILIATE = 'AFFILIATE';
}
