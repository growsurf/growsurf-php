<?php

namespace Growsurf\Core\Exceptions;

class InternalServerException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Growsurf Internal Server Exception';
}
