<?php

namespace Growsurf\Core\Exceptions;

class PermissionDeniedException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Growsurf Permission Denied Exception';
}
