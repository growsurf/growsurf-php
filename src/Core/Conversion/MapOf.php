<?php

declare(strict_types=1);

namespace Growsurf\Core\Conversion;

use Growsurf\Core\Conversion\Concerns\ArrayOf;
use Growsurf\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class MapOf implements Converter
{
    use ArrayOf;
}
