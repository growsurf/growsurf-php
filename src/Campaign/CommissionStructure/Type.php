<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CommissionStructure;

enum Type: string
{
    case PERCENT = 'PERCENT';

    case AMOUNT = 'AMOUNT';
}
