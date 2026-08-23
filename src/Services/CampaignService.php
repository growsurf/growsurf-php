<?php

declare(strict_types=1);

namespace Growsurf\Services;

use Growsurf\Campaign\AffiliateApplication;
use Growsurf\Campaign\AffiliateApplicationListResponse;
use Growsurf\Campaign\AffiliateInvite;
use Growsurf\Campaign\AffiliateInviteListResponse;
use Growsurf\Campaign\Campaign;
use Growsurf\Campaign\CampaignCreateMobileParticipantTokenParams\ReferralStatus;
use Growsurf\Campaign\CampaignCreateParams\Type;
use Growsurf\Campaign\CampaignGetAnalyticsResponse;
use Growsurf\Campaign\CampaignListCommissionsParams\Status;
use Growsurf\Campaign\CampaignListLeaderboardParams\LeaderboardType;
use Growsurf\Campaign\CampaignListReferralsParams\SortBy;
use Growsurf\Campaign\CampaignListResponse;
use Growsurf\Campaign\CampaignNewMobileParticipantTokenResponse;
use Growsurf\Campaign\CampaignRetrieveAnalyticsParams\Interval;
use Growsurf\Campaign\ParticipantCommissionList;
use Growsurf\Campaign\ParticipantList;
use Growsurf\Campaign\ParticipantPayoutList;
use Growsurf\Campaign\ReferralList;
use Growsurf\Campaign\RewardCreateParams;
use Growsurf\Client;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\Core\Util;
use Growsurf\RequestOptions;
use Growsurf\ServiceContracts\CampaignContract;
use Growsurf\Services\Campaign\CommissionService;
use Growsurf\Services\Campaign\DesignService;
use Growsurf\Services\Campaign\EmailsService;
use Growsurf\Services\Campaign\InstallationService;
use Growsurf\Services\Campaign\OptionsService;
use Growsurf\Services\Campaign\ParticipantService;
use Growsurf\Services\Campaign\RewardService;
use Growsurf\Services\Campaign\RewardsService;
use Growsurf\Services\Campaign\WebhooksService;

/**
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 * @phpstan-import-type RewardCreateParamsShape from \Growsurf\Campaign\RewardCreateParams
 */
final class CampaignService implements CampaignContract
{
    /**
     * @api
     */
    public CampaignRawService $raw;

    /**
     * @api
     */
    public ParticipantService $participant;

    /**
     * @api
     */
    public RewardService $reward;

    /**
     * @api
     */
    public CommissionService $commission;

    /**
     * @api
     */
    public RewardsService $rewards;

    /**
     * @api
     */
    public DesignService $design;

    /**
     * @api
     */
    public EmailsService $emails;

    /**
     * @api
     */
    public OptionsService $options;

    /**
     * @api
     */
    public InstallationService $installation;

    /**
     * @api
     */
    public WebhooksService $webhooks;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CampaignRawService($client);
        $this->participant = new ParticipantService($client);
        $this->reward = new RewardService($client);
        $this->commission = new CommissionService($client);
        $this->rewards = new RewardsService($client);
        $this->design = new DesignService($client);
        $this->emails = new EmailsService($client);
        $this->options = new OptionsService($client);
        $this->installation = new InstallationService($client);
        $this->webhooks = new WebhooksService($client);
    }

    /**
     * @api
     *
     * Retrieves a program for the given program ID.
     *
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): Campaign {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieves a list of your programs. Deleted programs are not returned.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): CampaignListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Creates a new program, plus any optional campaign rewards. The new program is created in `DRAFT` status and owned by the API key's bound team.
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
    ): Campaign {
        $params = Util::removeNulls(
            [
                'type' => $type,
                'companyLogoImageURL' => $companyLogoImageURL,
                'companyName' => $companyName,
                'currencyISO' => $currencyISO,
                'name' => $name,
                'rewards' => $rewards,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Updates a program's identity and lifecycle. Only the fields you send are changed. `type`, `urlId`, and `currencyISO` are immutable. Editor-tab configuration (design, emails, options, installation) is edited via the dedicated config sub-resources, not here. The program cannot be deleted via this endpoint.
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
    ): Campaign {
        $params = Util::removeNulls(
            [
                'companyLogoImageURL' => $companyLogoImageURL,
                'companyName' => $companyName,
                'name' => $name,
                'status' => $status,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Clones an existing program into a new `DRAFT` program. Integrations and credentials are not copied; active rewards are cloned.
     *
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function clone(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): Campaign {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->clone($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Creates or returns a participant using the same input behavior as Add Participant, then returns a participant-scoped token for GrowSurf mobile SDK participant endpoints. Use this endpoint from your backend after your mobile app authenticates a signed-in user. The program must have mobile SDK access enabled.
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
    ): CampaignNewMobileParticipantTokenResponse {
        $params = Util::removeNulls(
            [
                'email' => $email,
                'fingerprint' => $fingerprint,
                'firstName' => $firstName,
                'ipAddress' => $ipAddress,
                'lastName' => $lastName,
                'metadata' => $metadata,
                'mobileInstanceID' => $mobileInstanceID,
                'referralStatus' => $referralStatus,
                'referredBy' => $referredBy,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createMobileParticipantToken($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * **Affiliate programs only.** Retrieves a paged list of all participant commissions in an affiliate program.
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
    ): ParticipantCommissionList {
        $params = Util::removeNulls(
            ['limit' => $limit, 'nextID' => $nextID, 'status' => $status]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listCommissions($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieves participants in leaderboard order for the specified leaderboard type.
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
    ): ParticipantList {
        $params = Util::removeNulls(
            [
                'isMonthly' => $isMonthly,
                'leaderboardType' => $leaderboardType,
                'limit' => $limit,
                'nextID' => $nextID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listLeaderboard($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieves a paged list of participants in a program.
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
    ): ParticipantList {
        $params = Util::removeNulls(['limit' => $limit, 'nextID' => $nextID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listParticipants($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * **Affiliate programs only.** Retrieves a paged list of all participant payouts in an affiliate program.
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
    ): ParticipantPayoutList {
        $params = Util::removeNulls(
            ['limit' => $limit, 'nextID' => $nextID, 'status' => $status]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listPayouts($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieves a list of all referrals and email invites made by participants in a program.
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
    ): ReferralList {
        $params = Util::removeNulls(
            [
                'desc' => $desc,
                'email' => $email,
                'firstName' => $firstName,
                'lastName' => $lastName,
                'limit' => $limit,
                'nextID' => $nextID,
                'offset' => $offset,
                'referralStatus' => $referralStatus,
                'sortBy' => $sortBy,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listReferrals($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieves analytics for a program. Pass `interval` to also get a time-series (`series`)
     * alongside the totals, and `include` to add previous-period totals, status breakdowns,
     * derived rates, or email performance. Add `email` to `include` for `sent` (accepted for
     * delivery), `delivered`, `opened`, `clicked`, `bounced`, and `spamComplaints` metrics plus
     * per-email-type breakdowns. Email rates are ratios from `0` to `1`, and `isPartial`
     * identifies windows that begin before complete coverage.
     *
     * @param string $id growSurf program ID
     * @param int $days Last number of days to retrieve analytics for. Defaults to 365. Maximum 1825.
     * @param int $endDate End date of the analytics timeframe as a Unix timestamp in milliseconds. Required if `days` is not set.
     * @param string $include comma-separated list of optional data to include: `previousPeriod` adds totals for the equal-length window immediately before the requested one; `statusCounts` adds reward (and, for affiliate programs, affiliate/commission/payout) status breakdowns; `rates` adds derived referral rates; `email` adds `sent`, `delivered`, `opened`, `clicked`, `bounced`, `spamComplaints`, and per-email-type metrics. When `email` and an interval are both requested, each `series` item also contains counts for emails sent during that period. Combine `email` with `previousPeriod` to include the same email metrics in both windows
     * @param Interval|value-of<Interval> $interval When set to `day`, `week`, or `month`, the response also includes a `series` array with per-period totals. Defaults to `total` (no series).
     * @param int $startDate Start date of the analytics timeframe as a Unix timestamp in milliseconds. Required if `days` is not set.
     * @param RequestOpts|null $requestOptions
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
    ): CampaignGetAnalyticsResponse {
        $params = Util::removeNulls(
            [
                'days' => $days,
                'endDate' => $endDate,
                'include' => $include,
                'interval' => $interval,
                'startDate' => $startDate,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveAnalytics($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Lists an affiliate program's applications, newest first. Applications exist on programs that review public signups (an `affiliateApplicationMode` of `MANUAL_REVIEW` or `AUTO_APPROVE`). A pending applicant is not a participant until their application is approved.
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
    ): AffiliateApplicationListResponse {
        $params = Util::removeNulls(
            ['limit' => $limit, 'offset' => $offset, 'status' => $status]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listAffiliateApplications($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns one affiliate application, including its submitted form answers.
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
    ): AffiliateApplication {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveAffiliateApplication($id, $applicationID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Decides a pending application. Set `status` to `APPROVED` to enroll the applicant (this creates the participant, or upgrades an existing participant with the same email), or to `DENIED` with an optional `rejectionReason`. A denied applicant may reapply after the program's reapplication cooldown; send an earlier `reapplyAllowedAt` (without `status`) to shorten that wait for one applicant. Provide exactly one of `status` or `reapplyAllowedAt`. Denial-only fields are only valid with `status` set to `DENIED`. Approval is idempotent: repeating it returns the same participant.
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
    ): AffiliateApplication {
        $params = Util::removeNulls(
            [
                'allowImmediateReapply' => $allowImmediateReapply,
                'reapplyAllowedAt' => $reapplyAllowedAt,
                'rejectionReason' => $rejectionReason,
                'reviewNote' => $reviewNote,
                'status' => $status,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->reviewAffiliateApplication($id, $applicationID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Lists an affiliate program's enrollment invites, newest first.
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
    ): AffiliateInviteListResponse {
        $params = Util::removeNulls(
            ['limit' => $limit, 'offset' => $offset, 'status' => $status]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listAffiliateInvites($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Invites someone to join the affiliate program. GrowSurf emails them a single-use accept link; accepting it enrolls them as an approved affiliate without going through the public application. One active invite can exist per email address.
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
    ): AffiliateInvite {
        $params = Util::removeNulls(
            ['email' => $email, 'firstName' => $firstName, 'lastName' => $lastName]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createAffiliateInvite($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Revokes a pending invite. Its emailed accept link stops working immediately.
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
    ): AffiliateInvite {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->revokeAffiliateInvite($id, $inviteID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Re-sends a pending invite with a fresh accept link (the previous link stops working). Resends are rate limited per invite; retry after a few minutes if a resend was just sent.
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
    ): AffiliateInvite {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->resendAffiliateInvite($id, $inviteID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
