<?php

namespace Growsurf\Core\Exceptions;

class NotFoundException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Growsurf Not Found Exception';
}
