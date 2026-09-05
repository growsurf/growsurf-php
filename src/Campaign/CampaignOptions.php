<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

/**
 * Public array shapes for a program's open options configuration.
 *
 * @phpstan-type CampaignOptionsRecaptchaShape = array{isEnabled?: bool, siteKey?: string|null, ...<string, mixed>}
 * @phpstan-type CampaignOptionsFraudShape = array{blockedEmails?: list<string>, blockedIps?: list<string>, blockedCountries?: list<string>, allowedEmails?: list<string>, allowedIps?: list<string>, allowedCountries?: list<string>, blockBurnerEmails?: bool, blockDataCenterIps?: bool, blockHighRiskReferrers?: bool, autoBlockHighRiskIps?: bool, maxSignupsPerIp2Min?: int, maxSignupsPerIp10Min?: int, recaptcha?: CampaignOptionsRecaptchaShape, ...<string, mixed>}
 * @phpstan-type CampaignOptionsTaxDocumentationShape = array{companyName?: string|null, vatNumber?: string|null, addressLine1?: string|null, addressLine2?: string|null, city?: string|null, state?: string|null, postalCode?: string|null, country?: string|null, collectAffiliateVat?: bool, ...<string, mixed>}
 * @phpstan-type CampaignOptionsNotificationEventsShape = array{PARTICIPANT_REACHED_A_GOAL?: bool, NEW_PARTICIPANT_ADDED_NON_REFERRED?: bool, NEW_PARTICIPANT_ADDED_REFERRED?: bool, CAMPAIGN_ENDED?: bool, WEEKLY_PERFORMANCE_REPORT?: bool, MONTHLY_PERFORMANCE_REPORT?: bool, NEW_COMMISSION_ADDED?: bool, COMMISSION_ADJUSTED?: bool, NEW_PAYOUT_ISSUED?: bool, AFFILIATE_BATCH_PAYOUT_COMPLETED?: bool, MONTHLY_PAYOUT_REMINDER?: bool, AFFILIATE_APPLICATIONS_PENDING_REVIEW?: bool, ...<string, mixed>}
 * @phpstan-type CampaignOptionsNotificationEmailsShape = array{recipients?: list<string>, events?: CampaignOptionsNotificationEventsShape, ...<string, mixed>}
 * @phpstan-type CampaignOptionsShape = array{affiliateApplicationMode?: 'OPEN_ENROLLMENT'|'MANUAL_REVIEW'|'AUTO_APPROVE', affiliateReapplicationPolicy?: 'AFTER_COOLDOWN'|'DISABLED', affiliateReapplicationCooldownDays?: int, affiliateApplicationReviewEstimateBusinessDays?: int|null, requireManualRewardApproval?: bool, autoFulfillRewards?: bool, requireManualFraudApproval?: bool, autoBlockFraud?: bool, requireParticipantAuth?: bool, enforceGdprCompliance?: bool, blockPaidAdsTraffic?: bool, attributionModel?: 'LAST_CLICK'|'FIRST_CLICK', referralCookieWindowDays?: 1|3|7|14|30|60|90|180|365|400, referralCreditWindowDays?: 1|3|7|14|30|60|90|180|365|null, payoutThreshold?: int|null, fraud?: CampaignOptionsFraudShape, taxDocumentation?: CampaignOptionsTaxDocumentationShape, notificationEmails?: CampaignOptionsNotificationEmailsShape, ...<string, mixed>}
 * @phpstan-type CampaignOptionsRecaptchaUpdateShape = array{isEnabled?: bool, siteKey?: string|null, secretKey?: string|null, ...<string, mixed>}
 * @phpstan-type CampaignOptionsFraudUpdateShape = array{blockedEmails?: list<string>, blockedIps?: list<string>, blockedCountries?: list<string>, allowedEmails?: list<string>, allowedIps?: list<string>, allowedCountries?: list<string>, blockBurnerEmails?: bool, blockDataCenterIps?: bool, blockHighRiskReferrers?: bool, autoBlockHighRiskIps?: bool, maxSignupsPerIp2Min?: int, maxSignupsPerIp10Min?: int, recaptcha?: CampaignOptionsRecaptchaUpdateShape, ...<string, mixed>}
 * @phpstan-type CampaignOptionsTaxDocumentationUpdateShape = CampaignOptionsTaxDocumentationShape
 * @phpstan-type CampaignOptionsNotificationEmailsUpdateShape = CampaignOptionsNotificationEmailsShape
 * @phpstan-type CampaignOptionsUpdateShape = array{affiliateApplicationMode?: 'OPEN_ENROLLMENT'|'MANUAL_REVIEW'|'AUTO_APPROVE', affiliateReapplicationPolicy?: 'AFTER_COOLDOWN'|'DISABLED', affiliateReapplicationCooldownDays?: int, affiliateApplicationReviewEstimateBusinessDays?: int|null, requireManualRewardApproval?: bool, autoFulfillRewards?: bool, requireManualFraudApproval?: bool, autoBlockFraud?: bool, requireParticipantAuth?: bool, enforceGdprCompliance?: bool, blockPaidAdsTraffic?: bool, attributionModel?: 'LAST_CLICK'|'FIRST_CLICK', referralCookieWindowDays?: 1|3|7|14|30|60|90|180|365|400, referralCreditWindowDays?: 1|3|7|14|30|60|90|180|365|null, payoutThreshold?: int|null, fraud?: CampaignOptionsFraudUpdateShape, taxDocumentation?: CampaignOptionsTaxDocumentationUpdateShape, notificationEmails?: CampaignOptionsNotificationEmailsUpdateShape, ...<string, mixed>}
 */
final class CampaignOptions
{
    private function __construct() {}
}
