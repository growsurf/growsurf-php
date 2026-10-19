<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Reward;

/**
 * The starter icon shown for the reward, or `null` when `imageUrl` is your own image.
 */
enum ImageIconKey: string
{
    case GIFT_1 = 'GIFT_1';

    case GIFT_2 = 'GIFT_2';

    case GIFT_3 = 'GIFT_3';

    case GIFT_4 = 'GIFT_4';

    case GIFT_5 = 'GIFT_5';

    case GIFT_6 = 'GIFT_6';

    case GIFT_CARD = 'GIFT_CARD';

    case CASH = 'CASH';

    case COIN = 'COIN';

    case CARD = 'CARD';

    case STAR_1 = 'STAR_1';

    case STAR_2 = 'STAR_2';

    case STAR_3 = 'STAR_3';

    case TROPHY = 'TROPHY';

    case CROWN = 'CROWN';

    case SEAL = 'SEAL';

    case HEART_1 = 'HEART_1';

    case HEART_2 = 'HEART_2';

    case TAG = 'TAG';

    case DIAMOND = 'DIAMOND';

    case CONFETTI = 'CONFETTI';

    case ROCKET = 'ROCKET';
}
