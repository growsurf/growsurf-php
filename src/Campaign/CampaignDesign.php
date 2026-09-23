<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

/**
 * Public array shapes for a program's open Design configuration.
 *
 * `resources` controls participant presentation. Resource items and their order use the Program
 * Resources service. `widget` is the website widget shown in a corner of your own site, with its
 * colors under `theme.widget`; both of its audience switches start off, so a program shows nothing
 * until you turn one on. `trafficInsights` is the participant Traffic report. It starts on for new
 * affiliate programs and hidden for referral programs; `GET` returns every setting with its default
 * copy, a `PATCH` changes only the settings you send, and its labels cannot be blank.
 *
 * @phpstan-type ParticipantLoginDesignShape = array{heading?: string, description?: string, fieldLabel?: string, fieldPlaceholder?: string, buttonText?: string, successHeading?: string, successBody?: string, resendPrompt?: string, resend?: string, resent?: string, invalidEmail?: string, cooldown?: string, serverError?: string, invalidLink?: string, ...<string, mixed>}
 * @phpstan-type PayoutDestinationConfirmationErrorMessagesShape = array{invalidEmail?: string|null, emailMismatch?: string|null, tokenExpired?: string|null, tokenUsed?: string|null, alreadyConfirmed?: string|null, generic?: string|null}
 * @phpstan-type PayoutDestinationConfirmationDesignShape = array{headline?: string|null, description?: string|null, emailLabel?: string|null, emailPlaceholder?: string|null, emailAgainLabel?: string|null, emailAgainPlaceholder?: string|null, legalNameLabel?: string|null, legalNamePlaceholder?: string|null, legalTypeLabel?: string|null, legalTypeIndividual?: string|null, legalTypeBusiness?: string|null, button?: string|null, success?: string|null, claimPending?: string|null, errorMessages?: PayoutDestinationConfirmationErrorMessagesShape}
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
 *   emptyState?: string,
 *   icon?: CampaignDesignResourcesIconShape
 * }
 * @phpstan-type CampaignDesignReferredExperienceShape = array{
 *   isOfferPopupEnabled?: bool,
 *   offerPopupTitle?: string|null,
 *   offerPopupDescription?: string|null,
 *   offerPopupButtonText?: string|null,
 *   offerPopupImageUrl?: string|null,
 *   isOfferPopupReferrerImageShown?: bool,
 *   offerPopupPlacement?: 'CENTER'|'BOTTOM'|'BOTTOM_RIGHT'|'BOTTOM_LEFT'|'TOP',
 *   offerPopupDelaySeconds?: 0|3|5|10,
 *   offerPopupThankYouText?: string|null,
 *   offerPopupThankYouButtonText?: string|null,
 *   isOfferPopupConfettiEnabled?: bool,
 *   isOfferPopupShownOnAllPages?: bool,
 *   offerPopupSecondaryLinkText?: string|null,
 *   offerPopupSecondaryLinkUrl?: string|null,
 *   isOfferPopupOverlayDimmed?: bool,
 *   offerPopupEmailPlaceholder?: string|null,
 *   offerPopupPromoCodeCopyLabel?: string|null,
 *   offerPopupSubmitError?: string|null,
 *   isBannerEnabled?: bool,
 *   bannerText?: string|null,
 *   bannerPlacement?: 'TOP'|'BOTTOM',
 *   isBannerClickableToSignupUrl?: bool,
 *   isHeadingEnabled?: bool,
 *   headingText?: string|null,
 *   headingTarget?: 'H1'|'H2'|'H3'|'H4'|'H5',
 *   headingPlacement?: 'PREPEND'|'APPEND'|'REPLACE',
 *   isHeadingStyled?: bool,
 *   isHeadingClickableToSignupUrl?: bool,
 *   pageTitleReplacement?: string|null,
 *   referrerNameFormat?: 'FIRST'|'FIRST_LAST_INITIAL'|'FIRST_LAST',
 *   referrerNameFallback?: string|null,
 *   ...<string, mixed>
 * }
 * @phpstan-type CampaignDesignWidgetPageRulesShape = array{
 *   mode?: 'ALL'|'ONLY'|'EXCEPT',
 *   patterns?: list<string>
 * }
 * @phpstan-type CampaignDesignWidgetShape = array{
 *   isShownToNewVisitors?: bool,
 *   isShownToParticipants?: bool,
 *   appearance?: 'BUTTON'|'CARD',
 *   isArtShown?: bool,
 *   artImageUrl?: string|null,
 *   newVisitorText?: string|null,
 *   participantText?: string|null,
 *   newVisitorDescription?: string|null,
 *   participantDescription?: string|null,
 *   buttonText?: string|null,
 *   markKey?: 'GIFT'|'TICKET'|'DISCOUNT'|'CASH'|'PERK'|'SHARE'|'LINK'|'INVITE'|'FRIENDS'|'THANKS'|null,
 *   icon?: 'CUSTOM'|'NONE'|'DEFAULT',
 *   iconImageUrl?: string|null,
 *   placement?: 'TOP_LEFT'|'TOP_CENTER'|'TOP_RIGHT'|'BOTTOM_LEFT'|'BOTTOM_CENTER'|'BOTTOM_RIGHT',
 *   offsetSide?: int,
 *   offsetEdge?: int,
 *   reveal?: 'IMMEDIATE'|'DELAY'|'SCROLL',
 *   revealDelaySeconds?: int,
 *   returnAfterDays?: int,
 *   isHiddenOnMobile?: bool,
 *   pageRules?: CampaignDesignWidgetPageRulesShape,
 *   ...<string, mixed>
 * }
 * @phpstan-type CampaignDesignTrafficInsightsMetricShape = array{
 *   isVisible?: bool,
 *   label?: string,
 *   helperText?: string
 * }
 * @phpstan-type CampaignDesignTrafficInsightsBreakdownShape = array{
 *   isVisible?: bool,
 *   label?: string,
 *   levels?: array<string, string>,
 *   values?: array<string, string>
 * }
 * @phpstan-type CampaignDesignTrafficInsightsShape = array{
 *   isPublicDisplayed?: bool,
 *   title?: string,
 *   trafficForLabel?: string,
 *   allLinksLabel?: string,
 *   visitsOverTimeTitle?: string,
 *   breakdownsTitle?: string,
 *   viewTrafficInsightsLinkText?: string,
 *   backLinkText?: string,
 *   emptyState?: string,
 *   notSetLabel?: string,
 *   messages?: array{error?: string, unavailable?: string, partial?: string, partialFrom?: string, breakdownPartial?: string, breakdownEmpty?: string},
 *   dateRangeLabels?: array{LAST_7_DAYS?: string, LAST_30_DAYS?: string, LAST_90_DAYS?: string, ALL_TIME?: string},
 *   defaultDateRange?: 'LAST_7_DAYS'|'LAST_30_DAYS'|'LAST_90_DAYS'|'ALL_TIME',
 *   metrics?: array{visits?: CampaignDesignTrafficInsightsMetricShape, uniqueVisitors?: CampaignDesignTrafficInsightsMetricShape},
 *   breakdowns?: array{utm?: CampaignDesignTrafficInsightsBreakdownShape, referrer?: CampaignDesignTrafficInsightsBreakdownShape, destination?: CampaignDesignTrafficInsightsBreakdownShape, geo?: CampaignDesignTrafficInsightsBreakdownShape, technology?: CampaignDesignTrafficInsightsBreakdownShape, trigger?: CampaignDesignTrafficInsightsBreakdownShape}
 * }
 * @phpstan-type CampaignDesignThemeShape = array{referredExperienceOfferPopup?: array{color?: string|null, backgroundColor?: string|null, ...<string, mixed>}, widget?: array{color?: string|null, backgroundColor?: string|null, borderRadius?: string|null, ...<string, mixed>}, ...<string, mixed>}
 * @phpstan-type CampaignDesignShape = array{
 *   participantAvatarStyle?: 'CHARACTERS'|'INITIALS'|'ANIMALS'|'GRADIENT',
 *   window?: array<string, mixed>,
 *   header?: array<string, mixed>,
 *   stats?: array<string, mixed>,
 *   share?: array<string, mixed>,
 *   signup?: array<string, mixed>,
 *   login?: ParticipantLoginDesignShape,
 *   payoutDestinationConfirmation?: PayoutDestinationConfirmationDesignShape,
 *   countryLabels?: array<string, string|null>,
 *   referralStatus?: array<string, mixed>,
 *   leaderboard?: array<string, mixed>,
 *   referredExperience?: CampaignDesignReferredExperienceShape,
 *   widget?: CampaignDesignWidgetShape,
 *   trafficInsights?: CampaignDesignTrafficInsightsShape,
 *   referralSummary?: array<string, mixed>,
 *   affiliateSummary?: array<string, mixed>,
 *   commissions?: array<string, mixed>,
 *   payouts?: array<string, mixed>,
 *   rewards?: array<string, mixed>,
 *   resources?: CampaignDesignResourcesShape,
 *   participantSettings?: array<string, mixed>,
 *   landingPages?: array<string, mixed>,
 *   theme?: CampaignDesignThemeShape,
 *   ...<string, mixed>
 * }
 * @phpstan-type CampaignDesignUpdateShape = CampaignDesignShape
 */
final class CampaignDesign
{
    private function __construct() {}
}
