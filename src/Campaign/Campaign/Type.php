<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Campaign;

enum Type: string
{
    case REFERRAL = 'REFERRAL';

    case AFFILIATE = 'AFFILIATE';
}
