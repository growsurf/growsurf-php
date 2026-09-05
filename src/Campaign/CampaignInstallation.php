<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

/**
 * Public array shapes for a program's open installation configuration.
 *
 * @phpstan-type CampaignInstallationSignupShape = array{isCustomForm?: bool, url?: string|null, redirectAfterSignup?: bool, redirectUrl?: string|null, trackInputFields?: bool, ...<string, mixed>}
 * @phpstan-type CampaignInstallationMobileShape = array{isEnabled?: bool, publicKey?: string, iosAttributionUrl?: string|null, iosAppStoreUrl?: string|null, androidPackageName?: string|null, androidAppStoreUrl?: string|null, ...<string, mixed>}
 * @phpstan-type CampaignInstallationShape = array{referralTrigger?: 'CUSTOM'|'ON_SIGNUP', signupEvent?: 'FORM_DETECTION'|'PROGRAMMATIC', shareUrl?: string, useGrowSurfHostedLinks?: bool, allowedUrls?: list<string>, signup?: CampaignInstallationSignupShape, mobile?: CampaignInstallationMobileShape, ...<string, mixed>}
 * @phpstan-type CampaignInstallationSignupUpdateShape = CampaignInstallationSignupShape
 * @phpstan-type CampaignInstallationMobileUpdateShape = array{isEnabled?: bool, iosAttributionUrl?: string|null, iosAppStoreUrl?: string|null, androidPackageName?: string|null, androidAppStoreUrl?: string|null, ...<string, mixed>}
 * @phpstan-type CampaignInstallationUpdateShape = array{referralTrigger?: 'CUSTOM'|'ON_SIGNUP', signupEvent?: 'FORM_DETECTION'|'PROGRAMMATIC', shareUrl?: string, useGrowSurfHostedLinks?: bool, allowedUrls?: list<string>, signup?: CampaignInstallationSignupUpdateShape, mobile?: CampaignInstallationMobileUpdateShape, ...<string, mixed>}
 */
final class CampaignInstallation
{
    private function __construct() {}
}
