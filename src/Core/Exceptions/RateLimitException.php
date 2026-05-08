<?php

namespace Growsurf\Core\Exceptions;

class RateLimitException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Growsurf Rate Limit Exception';
}
