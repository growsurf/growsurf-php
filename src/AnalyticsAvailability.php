<?php

declare(strict_types=1);

namespace Growsurf;

/** Describes whether an analytics value is fully covered, partly covered, or unavailable. */
enum AnalyticsAvailability: string
{
    case AVAILABLE = 'AVAILABLE';

    case PARTIAL = 'PARTIAL';

    case UNAVAILABLE = 'UNAVAILABLE';
}
