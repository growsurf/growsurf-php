<?php

namespace Growsurf\Core\Exceptions;

class ConflictException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Growsurf Conflict Exception';
}
