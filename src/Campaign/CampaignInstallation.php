<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

/**
 * Public array shapes for a program's open installation configuration.
 *
 * @phpstan-type CampaignInstallationSignupShape = array{isCustomForm?: bool, url?: string|null, redirectAfterSignup?: bool, redirectUrl?: string|null, trackInputFields?: bool, ...<string, mixed>}
 * @phpstan-type CampaignInstallationMobileShape = array{isEnabled?: bool, publicKey?: string, iosAttributionUrl?: string|null, iosAppStoreUrl?: string|null, androidPackageName?: string|null, androidAppStoreUrl?: string|null, ...<string, mixed>}
 * @phpstan-type CampaignInstallationStepProvidersShape = array{step2Signup?: 'restApi'|'javascript', step2Affiliate?: 'stripe'|'chargebee'|'recurly'|'restApi', step2Referral?: 'restApi'|'zapier'|'stripe'|'chargebee'|'recurly'|'paypal'|'hubspot'|'salesforce', step3Affiliate?: 'paypal'|'wise', step3Referral?: 'webhooks'|'zapier'|'paypal'|'tangocard'|'stripe'|'chargebee'|'recurly', ...<string, mixed>}
 * @phpstan-type CampaignInstallationInstructionSelectionsShape = array{platform?: 'web'|'ios'|'android', mobileAttributionProvider?: 'branch'|'appsflyer'|'adjust'|'singular'|'other', stepProviders?: CampaignInstallationStepProvidersShape, ...<string, mixed>}
 * @phpstan-type CampaignInstallationShape = array{referralTrigger?: 'CUSTOM'|'ON_SIGNUP', signupEvent?: 'FORM_DETECTION'|'PROGRAMMATIC', shareUrl?: string, useGrowSurfHostedLinks?: bool, allowedUrls?: list<string>, signup?: CampaignInstallationSignupShape, mobile?: CampaignInstallationMobileShape, instructionSelections?: CampaignInstallationInstructionSelectionsShape, ...<string, mixed>}
 * @phpstan-type CampaignInstallationSignupUpdateShape = CampaignInstallationSignupShape
 * @phpstan-type CampaignInstallationMobileUpdateShape = array{isEnabled?: bool, iosAttributionUrl?: string|null, iosAppStoreUrl?: string|null, androidPackageName?: string|null, androidAppStoreUrl?: string|null, ...<string, mixed>}
 * @phpstan-type CampaignInstallationUpdateShape = array{referralTrigger?: 'CUSTOM'|'ON_SIGNUP', signupEvent?: 'FORM_DETECTION'|'PROGRAMMATIC', shareUrl?: string, useGrowSurfHostedLinks?: bool, allowedUrls?: list<string>, signup?: CampaignInstallationSignupUpdateShape, mobile?: CampaignInstallationMobileUpdateShape, instructionSelections?: CampaignInstallationInstructionSelectionsShape, ...<string, mixed>}
 */
final class CampaignInstallation
{
    private function __construct() {}
}
