<?php

namespace Growsurf\Core\Exceptions;

class BadRequestException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Growsurf Bad Request Exception';
}
