<?php

declare(strict_types=1);

namespace Growsurf;

/** Explains why an analytics value is not fully available. */
enum AnalyticsUnavailableReason: string
{
    case COVERAGE_UNAVAILABLE = 'COVERAGE_UNAVAILABLE';

    case PRE_COVERAGE = 'PRE_COVERAGE';

    case PARTIAL_COVERAGE = 'PARTIAL_COVERAGE';

    case INSUFFICIENT_COVERAGE = 'INSUFFICIENT_COVERAGE';

    case EMPTY_DENOMINATOR = 'EMPTY_DENOMINATOR';

    case QUERY_LIMIT_EXCEEDED = 'QUERY_LIMIT_EXCEEDED';

    case PARTICIPANT_NOT_ELIGIBLE = 'PARTICIPANT_NOT_ELIGIBLE';
}
