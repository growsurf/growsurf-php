<?php

namespace Growsurf\Core\Exceptions;

class AuthenticationException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Growsurf Authentication Exception';
}
