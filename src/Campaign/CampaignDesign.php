<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

/**
 * Public array shapes for a program's open Design configuration.
 *
 * `resources` controls participant presentation. Resource items and their order use the Program
 * Resources service.
 *
 * @phpstan-type CampaignDesignResourcesIconShape = array{
 *   type?: 'DEFAULT'|'IMAGE'|'NONE',
 *   imageUrl?: string
 * }
 * @phpstan-type CampaignDesignResourcesShape = array{
 *   isPublicDisplayed?: bool,
 *   title?: string,
 *   viewResourcesLinkText?: string,
 *   backLinkText?: string,
 *   copyButtonText?: string,
 *   copiedText?: string,
 *   icon?: CampaignDesignResourcesIconShape
 * }
 * @phpstan-type CampaignDesignShape = array{
 *   resources?: CampaignDesignResourcesShape,
 *   ...<string, mixed>
 * }
 */
final class CampaignDesign
{
    private function __construct() {}
}
