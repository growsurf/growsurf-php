<?php

declare(strict_types=1);

namespace Growsurf\Campaign\AffiliateApplicationAnswer;

/**
 * Saved-form field type that determined how the scalar answer was validated.
 */
enum Type: string
{
    case TEXT = 'text';

    case TEXTAREA = 'textarea';

    case URL = 'url';

    case COUNTRY = 'country';

    case NUMBER = 'number';

    case DROPDOWN = 'dropdown';

    case RADIO = 'radio';

    case CHECKBOX = 'checkbox';
}
