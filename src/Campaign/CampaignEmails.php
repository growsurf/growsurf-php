<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

/**
 * Public array shapes for a program's open email configuration.
 *
 * @phpstan-type CampaignEmailTemplateShape = array{subject?: string, preheader?: string, body?: string, isEnabled?: bool, ...<string, mixed>}
 * @phpstan-type CampaignInviteEmailTemplateShape = array{subject?: string, preheader?: string, body?: string, isEnabled?: bool, useCompanyReplyTo?: bool, ...<string, mixed>}
 * @phpstan-type CampaignEmailSenderSettingsShape = array{fromName?: string, replyToEmail?: string, fromEmail?: string, ...<string, mixed>}
 * @phpstan-type CampaignEmailContactSettingsShape = array{companyName?: string, addressLine1?: string, addressLine2?: string|null, city?: string, state?: string|null, postalCode?: string|null, country?: string|null, ...<string, mixed>}
 * @phpstan-type CampaignEmailDesignSettingsShape = array{header?: string|null, footer?: string|null, unsubscribePromotional?: string, unsubscribeInvite?: string, unsubscribeAffiliateInvite?: string, unsubscribeTransactional?: string, ...<string, mixed>}
 * @phpstan-type CampaignEmailSettingsShape = array{sender?: CampaignEmailSenderSettingsShape, contact?: CampaignEmailContactSettingsShape, design?: CampaignEmailDesignSettingsShape, ...<string, mixed>}
 * @phpstan-type CampaignEmailsShape = array{
 *   welcomeNonReferred?: CampaignEmailTemplateShape,
 *   welcomeReferred?: CampaignEmailTemplateShape,
 *   offerClaimed?: CampaignEmailTemplateShape,
 *   referralLinkViewedFirstTime?: CampaignEmailTemplateShape,
 *   referralLinkUsed?: CampaignEmailTemplateShape,
 *   referredSignup?: CampaignEmailTemplateShape,
 *   goalAchieved?: CampaignEmailTemplateShape,
 *   campaignEndedWinners?: CampaignEmailTemplateShape,
 *   campaignEndedNonWinners?: CampaignEmailTemplateShape,
 *   progressUpdateMonthly?: CampaignEmailTemplateShape,
 *   commissionGenerated?: CampaignEmailTemplateShape,
 *   commissionAdjusted?: CampaignEmailTemplateShape,
 *   payoutPending?: CampaignEmailTemplateShape,
 *   payoutSentSuccess?: CampaignEmailTemplateShape,
 *   invite?: CampaignInviteEmailTemplateShape,
 *   loginLink?: CampaignEmailTemplateShape,
 *   payoutDestinationConfirmation?: CampaignEmailTemplateShape,
 *   payoutDestinationChanged?: CampaignEmailTemplateShape,
 *   taxInfoMissing?: CampaignEmailTemplateShape,
 *   taxInfoReceived?: CampaignEmailTemplateShape,
 *   taxInfoApproved?: CampaignEmailTemplateShape,
 *   taxInfoRejected?: CampaignEmailTemplateShape,
 *   affiliateApplicationReceived?: CampaignEmailTemplateShape,
 *   affiliateApplicationApproved?: CampaignEmailTemplateShape,
 *   affiliateApplicationDenied?: CampaignEmailTemplateShape,
 *   inviteAffiliate?: CampaignEmailTemplateShape,
 *   affiliateApplicationStatusLink?: CampaignEmailTemplateShape,
 *   affiliateApplicationEmailCorrection?: CampaignEmailTemplateShape,
 *   affiliateEmailChangeVerification?: CampaignEmailTemplateShape,
 *   settings?: CampaignEmailSettingsShape,
 *   ...<string, mixed>
 * }
 * @phpstan-type CampaignEmailTemplateUpdateShape = CampaignEmailTemplateShape
 * @phpstan-type CampaignInviteEmailTemplateUpdateShape = CampaignInviteEmailTemplateShape
 * @phpstan-type CampaignEmailSenderSettingsUpdateShape = array{fromName?: string, replyToEmail?: string, ...<string, mixed>}
 * @phpstan-type CampaignEmailContactSettingsUpdateShape = CampaignEmailContactSettingsShape
 * @phpstan-type CampaignEmailDesignSettingsUpdateShape = CampaignEmailDesignSettingsShape
 * @phpstan-type CampaignEmailSettingsUpdateShape = array{sender?: CampaignEmailSenderSettingsUpdateShape, contact?: CampaignEmailContactSettingsUpdateShape, design?: CampaignEmailDesignSettingsUpdateShape, ...<string, mixed>}
 * @phpstan-type CampaignEmailsUpdateShape = array{
 *   welcomeNonReferred?: CampaignEmailTemplateUpdateShape,
 *   welcomeReferred?: CampaignEmailTemplateUpdateShape,
 *   offerClaimed?: CampaignEmailTemplateUpdateShape,
 *   referralLinkViewedFirstTime?: CampaignEmailTemplateUpdateShape,
 *   referralLinkUsed?: CampaignEmailTemplateUpdateShape,
 *   referredSignup?: CampaignEmailTemplateUpdateShape,
 *   goalAchieved?: CampaignEmailTemplateUpdateShape,
 *   campaignEndedWinners?: CampaignEmailTemplateUpdateShape,
 *   campaignEndedNonWinners?: CampaignEmailTemplateUpdateShape,
 *   progressUpdateMonthly?: CampaignEmailTemplateUpdateShape,
 *   commissionGenerated?: CampaignEmailTemplateUpdateShape,
 *   commissionAdjusted?: CampaignEmailTemplateUpdateShape,
 *   payoutPending?: CampaignEmailTemplateUpdateShape,
 *   payoutSentSuccess?: CampaignEmailTemplateUpdateShape,
 *   invite?: CampaignInviteEmailTemplateUpdateShape,
 *   loginLink?: CampaignEmailTemplateUpdateShape,
 *   payoutDestinationConfirmation?: CampaignEmailTemplateUpdateShape,
 *   payoutDestinationChanged?: CampaignEmailTemplateUpdateShape,
 *   taxInfoMissing?: CampaignEmailTemplateUpdateShape,
 *   taxInfoReceived?: CampaignEmailTemplateUpdateShape,
 *   taxInfoApproved?: CampaignEmailTemplateUpdateShape,
 *   taxInfoRejected?: CampaignEmailTemplateUpdateShape,
 *   affiliateApplicationReceived?: CampaignEmailTemplateUpdateShape,
 *   affiliateApplicationApproved?: CampaignEmailTemplateUpdateShape,
 *   affiliateApplicationDenied?: CampaignEmailTemplateUpdateShape,
 *   inviteAffiliate?: CampaignEmailTemplateUpdateShape,
 *   affiliateApplicationStatusLink?: CampaignEmailTemplateUpdateShape,
 *   affiliateApplicationEmailCorrection?: CampaignEmailTemplateUpdateShape,
 *   affiliateEmailChangeVerification?: CampaignEmailTemplateUpdateShape,
 *   settings?: CampaignEmailSettingsUpdateShape,
 *   ...<string, mixed>
 * }
 */
final class CampaignEmails
{
    private function __construct() {}
}
