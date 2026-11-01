<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignCustomDomain\DnsRecord;

/**
 * The record type. Always `CNAME`.
 */
enum Type: string
{
    case CNAME = 'CNAME';
}
