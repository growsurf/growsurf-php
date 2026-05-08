<?php

namespace Growsurf\Core\Exceptions;

class UnprocessableEntityException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Growsurf Unprocessable Entity Exception';
}
