<?php

declare(strict_types=1);

namespace Growsurf\Core\Conversion\Contracts;

use Growsurf\Core\Conversion\CoerceState;
use Growsurf\Core\Conversion\DumpState;

/**
 * @internal
 */
interface Converter
{
    /**
     * @internal
     */
    public function coerce(mixed $value, CoerceState $state): mixed;

    /**
     * @internal
     */
    public function dump(mixed $value, DumpState $state): mixed;
}
