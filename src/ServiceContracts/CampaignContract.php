<?php

declare(strict_types=1);

namespace Growsurf\ServiceContracts;

use Growsurf\Campaign\AffiliateApplication;
use Growsurf\Campaign\AffiliateApplicationListResponse;
use Growsurf\Campaign\AffiliateInvite;
use Growsurf\Campaign\AffiliateInviteListResponse;
use Growsurf\Campaign\Campaign;
use Growsurf\Campaign\CampaignActivationAnalyticsResponse;
use Growsurf\Campaign\CampaignCreateMobileParticipantTokenParams\ReferralStatus;
use Growsurf\Campaign\CampaignCreateParams\Type;
use Growsurf\Campaign\CampaignGetAnalyticsResponse;
use Growsurf\Campaign\CampaignListCommissionsParams\Status;
use Growsurf\Campaign\CampaignListLeaderboardParams\LeaderboardType;
use Growsurf\Campaign\CampaignListReferralsParams\SortBy;
use Growsurf\Campaign\CampaignListResponse;
use Growsurf\Campaign\CampaignNewMobileParticipantTokenResponse;
use Growsurf\Campaign\CampaignRetrieveActivationAnalyticsParams\CohortInterval;
use Growsurf\Campaign\CampaignRetrieveActivationAnalyticsParams\ObservationWindowDays;
use Growsurf\Campaign\CampaignRetrieveAnalyticsParams\Interval;
use Growsurf\Campaign\CampaignRetrieveAnalyticsParams\Platform;
use Growsurf\Campaign\ParticipantCommissionList;
use Growsurf\Campaign\ParticipantList;
use Growsurf\Campaign\ParticipantPayoutList;
use Growsurf\Campaign\ReferralList;
use Growsurf\Campaign\RewardCreateParams;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 * @phpstan-import-type RewardCreateParamsShape from \Growsurf\Campaign\RewardCreateParams
 */
interface CampaignContract
{
    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): Campaign;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): CampaignListResponse;

    /**
     * @api
     *
     * @param Type|value-of<Type> $type The program type. Immutable after creation.
     * @param string $currencyISO ISO 4217 currency code. Defaults to USD. Chosen when the program is created and immutable afterward — it cannot be changed on update.
     * @param string $name The program name. Defaults to a generated friendly label plus the creation date.
     * @param list<RewardCreateParams|RewardCreateParamsShape> $rewards optional inline rewards to create with the program
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        Type|string $type,
        ?string $companyLogoImageURL = null,
        ?string $companyName = null,
        ?string $currencyISO = null,
        ?string $name = null,
        ?array $rewards = null,
        RequestOptions|array|null $requestOptions = null,
    ): Campaign;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param \Growsurf\Campaign\CampaignUpdateParams\Status|value-of<\Growsurf\Campaign\CampaignUpdateParams\Status> $status The requested program status. `IN_PROGRESS` publishes or resumes the program; `COMPLETE` ends it. Any other value returns a `400`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        ?string $companyLogoImageURL = null,
        ?string $companyName = null,
        ?string $name = null,
        \Growsurf\Campaign\CampaignUpdateParams\Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): Campaign;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function clone(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): Campaign;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param array<string,mixed> $metadata shallow custom metadata object
     * @param string $mobileInstanceID Optional app-install scoped identifier for native mobile anti-fraud. Recommended for mobile participant creation and mobile participant token flows. The official mobile SDKs generate this as a lowercase UUID.
     * @param ReferralStatus|value-of<ReferralStatus> $referralStatus
     * @param string $referredBy referrer participant ID or email address
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createMobileParticipantToken(
        string $id,
        string $email,
        ?string $fingerprint = null,
        ?string $firstName = null,
        ?string $ipAddress = null,
        ?string $lastName = null,
        ?array $metadata = null,
        ?string $mobileInstanceID = null,
        ReferralStatus|string|null $referralStatus = null,
        ?string $referredBy = null,
        RequestOptions|array|null $requestOptions = null,
    ): CampaignNewMobileParticipantTokenResponse;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param int $limit Number of results to return. Maximum 100.
     * @param string $nextID ID to start the next paged result set with
     * @param Status|value-of<Status> $status participant commission status
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listCommissions(
        string $id,
        int $limit = 10,
        ?string $nextID = null,
        Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): ParticipantCommissionList;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param bool $isMonthly Deprecated. Use `leaderboardType=CURRENT_MONTH` instead.
     * @param LeaderboardType|value-of<LeaderboardType> $leaderboardType leaderboard ordering mode
     * @param int $limit Number of results to return. Maximum 100.
     * @param string $nextID ID to start the next paged result set with
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listLeaderboard(
        string $id,
        bool $isMonthly = false,
        LeaderboardType|string $leaderboardType = 'ALL_TIME',
        int $limit = 10,
        ?string $nextID = null,
        RequestOptions|array|null $requestOptions = null,
    ): ParticipantList;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param int $limit Number of results to return. Maximum 100.
     * @param string $nextID ID to start the next paged result set with
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listParticipants(
        string $id,
        int $limit = 10,
        ?string $nextID = null,
        RequestOptions|array|null $requestOptions = null,
    ): ParticipantList;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param int $limit Number of results to return. Maximum 100.
     * @param string $nextID ID to start the next paged result set with
     * @param \Growsurf\Campaign\CampaignListPayoutsParams\Status|value-of<\Growsurf\Campaign\CampaignListPayoutsParams\Status> $status participant payout status
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listPayouts(
        string $id,
        int $limit = 10,
        ?string $nextID = null,
        \Growsurf\Campaign\CampaignListPayoutsParams\Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): ParticipantPayoutList;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param bool $desc return results in descending order when true
     * @param string $email URL-encoded email value to filter referral results
     * @param string $firstName first name value to filter results
     * @param string $lastName last name value to filter results
     * @param int $limit Number of results to return. Maximum 100.
     * @param string $nextID ID to start the next paged result set with
     * @param int $offset offset number used to skip through a result set
     * @param \Growsurf\Campaign\Participant\ReferralStatus|value-of<\Growsurf\Campaign\Participant\ReferralStatus> $referralStatus
     * @param SortBy|value-of<SortBy> $sortBy field used to sort referral results
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listReferrals(
        string $id,
        bool $desc = true,
        ?string $email = null,
        ?string $firstName = null,
        ?string $lastName = null,
        int $limit = 10,
        ?string $nextID = null,
        ?int $offset = null,
        \Growsurf\Campaign\Participant\ReferralStatus|string|null $referralStatus = null,
        SortBy|string $sortBy = 'updatedAt',
        RequestOptions|array|null $requestOptions = null,
    ): ReferralList;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param int $days Last number of days to retrieve analytics for. Defaults to 365. Maximum 1825.
     * @param int $endDate End date of the analytics timeframe as a Unix timestamp in milliseconds. Required if `days` is not set.
     * @param string $include Comma-separated optional data. `engagement` adds covered participant activity; `previousPeriod`, `statusCounts`, `rates`, and `email` preserve their existing behavior.
     * @param Interval|value-of<Interval> $interval When set to `day`, `week`, or `month`, the response also includes a `series` array with per-period totals and uses the same bucket size for `engagement.series`. Defaults to `total` (no legacy series); `engagement.series` uses daily buckets when `interval` is `total` or omitted.
     * @param int $startDate Start date of the analytics timeframe as a Unix timestamp in milliseconds. Required if `days` is not set.
     * @param RequestOpts|null $requestOptions
     * @param Platform|value-of<Platform> $platform Platform filter for `engagement`. Defaults to `ALL`.
     * @param string $timezone IANA timezone for engagement period boundaries. Defaults to `UTC`.
     *
     * @throws APIException
     */
    public function retrieveAnalytics(
        string $id,
        int $days = 365,
        ?int $endDate = null,
        ?string $include = null,
        Interval|string|null $interval = null,
        ?int $startDate = null,
        RequestOptions|array|null $requestOptions = null,
        Platform|string|null $platform = null,
        ?string $timezone = null,
    ): CampaignGetAnalyticsResponse;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param int $cohortFrom inclusive cohort enrollment start as a Unix timestamp in milliseconds
     * @param int $cohortTo exclusive cohort enrollment end as a Unix timestamp in milliseconds
     * @param CohortInterval|value-of<CohortInterval> $cohortInterval Cohort bucket size. Defaults to `day`.
     * @param ObservationWindowDays|value-of<ObservationWindowDays> $observationWindowDays Days after enrollment allowed for each participant to reach a stage. Defaults to `30`.
     * @param string $timezone IANA timezone used for cohort bounds. Defaults to `UTC`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveActivationAnalytics(
        string $id,
        ?int $cohortFrom = null,
        ?int $cohortTo = null,
        CohortInterval|string|null $cohortInterval = null,
        ObservationWindowDays|int|null $observationWindowDays = null,
        ?string $timezone = null,
        RequestOptions|array|null $requestOptions = null,
    ): CampaignActivationAnalyticsResponse;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param int $limit how many applications to return per page (1-100)
     * @param int $offset offset number used to skip through a result set
     * @param \Growsurf\Campaign\CampaignListAffiliateApplicationsParams\Status|value-of<\Growsurf\Campaign\CampaignListAffiliateApplicationsParams\Status> $status only return applications with this status
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listAffiliateApplications(
        string $id,
        int $limit = 10,
        ?int $offset = null,
        \Growsurf\Campaign\CampaignListAffiliateApplicationsParams\Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): AffiliateApplicationListResponse;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param string $applicationID affiliate application ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveAffiliateApplication(
        string $id,
        string $applicationID,
        RequestOptions|array|null $requestOptions = null,
    ): AffiliateApplication;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param string $applicationID affiliate application ID
     * @param bool $allowImmediateReapply when denying, let the applicant reapply right away instead of waiting out the program's reapplication cooldown; only valid when `status` is `DENIED`
     * @param int $reapplyAllowedAt For an already-denied application, move the reapplication window to this earlier time, in Unix milliseconds. Send without `status`.
     * @param string $rejectionReason short reason recorded with a denial; only valid when `status` is `DENIED`; maximum 255 characters
     * @param string $reviewNote Private note recorded with a denial; only valid when `status` is `DENIED`; never shown to the applicant; maximum 500 characters
     * @param \Growsurf\Campaign\CampaignReviewAffiliateApplicationParams\Status|value-of<\Growsurf\Campaign\CampaignReviewAffiliateApplicationParams\Status> $status The decision. `APPROVED` enrolls the applicant as an affiliate; `DENIED` closes the application.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function reviewAffiliateApplication(
        string $id,
        string $applicationID,
        ?bool $allowImmediateReapply = null,
        ?int $reapplyAllowedAt = null,
        ?string $rejectionReason = null,
        ?string $reviewNote = null,
        \Growsurf\Campaign\CampaignReviewAffiliateApplicationParams\Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): AffiliateApplication;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param int $limit how many invites to return per page (1-100)
     * @param int $offset offset number used to skip through a result set
     * @param \Growsurf\Campaign\CampaignListAffiliateInvitesParams\Status|value-of<\Growsurf\Campaign\CampaignListAffiliateInvitesParams\Status> $status only return invites with this status
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listAffiliateInvites(
        string $id,
        int $limit = 10,
        ?int $offset = null,
        \Growsurf\Campaign\CampaignListAffiliateInvitesParams\Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): AffiliateInviteListResponse;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param string $email valid email address to invite; maximum 255 characters
     * @param string $firstName invitee first name, used in the invite email; maximum 255 characters
     * @param string $lastName invitee last name; maximum 255 characters
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createAffiliateInvite(
        string $id,
        string $email,
        ?string $firstName = null,
        ?string $lastName = null,
        RequestOptions|array|null $requestOptions = null,
    ): AffiliateInvite;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param string $inviteID affiliate invite ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function revokeAffiliateInvite(
        string $id,
        string $inviteID,
        RequestOptions|array|null $requestOptions = null,
    ): AffiliateInvite;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param string $inviteID affiliate invite ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function resendAffiliateInvite(
        string $id,
        string $inviteID,
        RequestOptions|array|null $requestOptions = null,
    ): AffiliateInvite;
}
