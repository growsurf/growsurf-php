<?php

declare(strict_types=1);

namespace Growsurf\Services;

use Growsurf\Campaign\AffiliateApplication;
use Growsurf\Campaign\AffiliateApplicationListResponse;
use Growsurf\Campaign\AffiliateInvite;
use Growsurf\Campaign\AffiliateInviteListResponse;
use Growsurf\Campaign\Campaign;
use Growsurf\Campaign\CampaignCreateAffiliateInviteParams;
use Growsurf\Campaign\CampaignCreateMobileParticipantTokenParams;
use Growsurf\Campaign\CampaignCreateMobileParticipantTokenParams\ReferralStatus;
use Growsurf\Campaign\CampaignCreateParams;
use Growsurf\Campaign\CampaignCreateParams\Type;
use Growsurf\Campaign\CampaignGetAnalyticsResponse;
use Growsurf\Campaign\CampaignListAffiliateApplicationsParams;
use Growsurf\Campaign\CampaignListAffiliateInvitesParams;
use Growsurf\Campaign\CampaignListCommissionsParams;
use Growsurf\Campaign\CampaignListCommissionsParams\Status;
use Growsurf\Campaign\CampaignListLeaderboardParams;
use Growsurf\Campaign\CampaignListLeaderboardParams\LeaderboardType;
use Growsurf\Campaign\CampaignListParticipantsParams;
use Growsurf\Campaign\CampaignListPayoutsParams;
use Growsurf\Campaign\CampaignListReferralsParams;
use Growsurf\Campaign\CampaignListReferralsParams\SortBy;
use Growsurf\Campaign\CampaignListResponse;
use Growsurf\Campaign\CampaignNewMobileParticipantTokenResponse;
use Growsurf\Campaign\CampaignRetrieveAnalyticsParams;
use Growsurf\Campaign\CampaignRetrieveAnalyticsParams\Interval;
use Growsurf\Campaign\CampaignReviewAffiliateApplicationParams;
use Growsurf\Campaign\CampaignUpdateParams;
use Growsurf\Campaign\ParticipantCommissionList;
use Growsurf\Campaign\ParticipantList;
use Growsurf\Campaign\ParticipantPayoutList;
use Growsurf\Campaign\ReferralList;
use Growsurf\Campaign\RewardCreateParams;
use Growsurf\Client;
use Growsurf\Core\Contracts\BaseResponse;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\Core\Util;
use Growsurf\RequestOptions;
use Growsurf\ServiceContracts\CampaignRawContract;

/**
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 * @phpstan-import-type RewardCreateParamsShape from \Growsurf\Campaign\RewardCreateParams
 */
final class CampaignRawService implements CampaignRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieves a program for the given program ID.
     *
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Campaign>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['campaign/%1$s', $id],
            options: $requestOptions,
            convert: Campaign::class,
        );
    }

    /**
     * @api
     *
     * Retrieves a list of your programs. Deleted programs are not returned.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CampaignListResponse>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'campaigns',
            options: $requestOptions,
            convert: CampaignListResponse::class,
        );
    }

    /**
     * @api
     *
     * Creates a new program, plus any optional campaign rewards. The new program is created in `DRAFT` status and owned by the API key's bound team.
     *
     * @param array{
     *   type: Type|value-of<Type>,
     *   companyLogoImageURL?: string,
     *   companyName?: string,
     *   currencyISO?: string,
     *   name?: string,
     *   rewards?: list<RewardCreateParams|RewardCreateParamsShape>,
     * }|CampaignCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Campaign>
     *
     * @throws APIException
     */
    public function create(
        array|CampaignCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CampaignCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'campaigns',
            body: (object) $parsed,
            options: $options,
            convert: Campaign::class,
        );
    }

    /**
     * @api
     *
     * Updates a program's identity and lifecycle. Only the fields you send are changed. `type`, `urlId`, and `currencyISO` are immutable. Editor-tab configuration (design, emails, options, installation) is edited via the dedicated config sub-resources, not here. The program cannot be deleted via this endpoint.
     *
     * @param string $id growSurf program ID
     * @param array{
     *   companyLogoImageURL?: string,
     *   companyName?: string,
     *   name?: string,
     *   status?: CampaignUpdateParams\Status|value-of<CampaignUpdateParams\Status>,
     * }|CampaignUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Campaign>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|CampaignUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CampaignUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['campaign/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: Campaign::class,
        );
    }

    /**
     * @api
     *
     * Clones an existing program into a new `DRAFT` program. Integrations and credentials are not copied; active rewards are cloned.
     *
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Campaign>
     *
     * @throws APIException
     */
    public function clone(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['campaign/%1$s/clone', $id],
            options: $requestOptions,
            convert: Campaign::class,
        );
    }

    /**
     * @api
     *
     * Creates or returns a participant using the same input behavior as Add Participant, then returns a participant-scoped token for GrowSurf mobile SDK participant endpoints. Use this endpoint from your backend after your mobile app authenticates a signed-in user. The program must have mobile SDK access enabled.
     *
     * @param string $id growSurf program ID
     * @param array{
     *   email: string,
     *   fingerprint?: string,
     *   firstName?: string,
     *   ipAddress?: string,
     *   lastName?: string,
     *   metadata?: array<string,mixed>,
     *   mobileInstanceID?: string,
     *   referralStatus?: ReferralStatus|value-of<ReferralStatus>,
     *   referredBy?: string,
     * }|CampaignCreateMobileParticipantTokenParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CampaignNewMobileParticipantTokenResponse>
     *
     * @throws APIException
     */
    public function createMobileParticipantToken(
        string $id,
        array|CampaignCreateMobileParticipantTokenParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CampaignCreateMobileParticipantTokenParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['campaign/%1$s/mobile-participant-token', $id],
            body: (object) $parsed,
            options: $options,
            convert: CampaignNewMobileParticipantTokenResponse::class,
        );
    }

    /**
     * @api
     *
     * **Affiliate programs only.** Retrieves a paged list of all participant commissions in an affiliate program.
     *
     * @param string $id growSurf program ID
     * @param array{
     *   limit?: int, nextID?: string, status?: Status|value-of<Status>
     * }|CampaignListCommissionsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ParticipantCommissionList>
     *
     * @throws APIException
     */
    public function listCommissions(
        string $id,
        array|CampaignListCommissionsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CampaignListCommissionsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['campaign/%1$s/commissions', $id],
            query: Util::array_transform_keys($parsed, ['nextID' => 'nextId']),
            options: $options,
            convert: ParticipantCommissionList::class,
        );
    }

    /**
     * @api
     *
     * Retrieves participants in leaderboard order for the specified leaderboard type.
     *
     * @param string $id growSurf program ID
     * @param array{
     *   isMonthly?: bool,
     *   leaderboardType?: value-of<LeaderboardType>,
     *   limit?: int,
     *   nextID?: string,
     * }|CampaignListLeaderboardParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ParticipantList>
     *
     * @throws APIException
     */
    public function listLeaderboard(
        string $id,
        array|CampaignListLeaderboardParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CampaignListLeaderboardParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['campaign/%1$s/leaderboard', $id],
            query: Util::array_transform_keys($parsed, ['nextID' => 'nextId']),
            options: $options,
            convert: ParticipantList::class,
        );
    }

    /**
     * @api
     *
     * Retrieves a paged list of participants in a program.
     *
     * @param string $id growSurf program ID
     * @param array{
     *   limit?: int, nextID?: string
     * }|CampaignListParticipantsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ParticipantList>
     *
     * @throws APIException
     */
    public function listParticipants(
        string $id,
        array|CampaignListParticipantsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CampaignListParticipantsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['campaign/%1$s/participants', $id],
            query: Util::array_transform_keys($parsed, ['nextID' => 'nextId']),
            options: $options,
            convert: ParticipantList::class,
        );
    }

    /**
     * @api
     *
     * **Affiliate programs only.** Retrieves a paged list of all participant payouts in an affiliate program.
     *
     * @param string $id growSurf program ID
     * @param array{
     *   limit?: int,
     *   nextID?: string,
     *   status?: CampaignListPayoutsParams\Status|value-of<CampaignListPayoutsParams\Status>,
     * }|CampaignListPayoutsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ParticipantPayoutList>
     *
     * @throws APIException
     */
    public function listPayouts(
        string $id,
        array|CampaignListPayoutsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CampaignListPayoutsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['campaign/%1$s/payouts', $id],
            query: Util::array_transform_keys($parsed, ['nextID' => 'nextId']),
            options: $options,
            convert: ParticipantPayoutList::class,
        );
    }

    /**
     * @api
     *
     * Retrieves a list of all referrals and email invites made by participants in a program.
     *
     * @param string $id growSurf program ID
     * @param array{
     *   desc?: bool,
     *   email?: string,
     *   firstName?: string,
     *   lastName?: string,
     *   limit?: int,
     *   nextID?: string,
     *   offset?: int,
     *   referralStatus?: \Growsurf\Campaign\Participant\ReferralStatus|value-of<\Growsurf\Campaign\Participant\ReferralStatus>,
     *   sortBy?: value-of<SortBy>,
     * }|CampaignListReferralsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ReferralList>
     *
     * @throws APIException
     */
    public function listReferrals(
        string $id,
        array|CampaignListReferralsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CampaignListReferralsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['campaign/%1$s/referrals', $id],
            query: Util::array_transform_keys($parsed, ['nextID' => 'nextId']),
            options: $options,
            convert: ReferralList::class,
        );
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
     * @param array{
     *   days?: int,
     *   endDate?: int,
     *   include?: string,
     *   interval?: Interval|value-of<Interval>,
     *   startDate?: int,
     * }|CampaignRetrieveAnalyticsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CampaignGetAnalyticsResponse>
     *
     * @throws APIException
     */
    public function retrieveAnalytics(
        string $id,
        array|CampaignRetrieveAnalyticsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CampaignRetrieveAnalyticsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['campaign/%1$s/analytics', $id],
            query: $parsed,
            options: $options,
            convert: CampaignGetAnalyticsResponse::class,
        );
    }

    /**
     * @api
     *
     * Lists an affiliate program's applications, newest first. Applications exist on programs that review public signups (an `affiliateApplicationMode` of `MANUAL_REVIEW` or `AUTO_APPROVE`). A pending applicant is not a participant until their application is approved.
     *
     * @param string $id growSurf program ID
     * @param array{
     *   limit?: int,
     *   offset?: int,
     *   status?: CampaignListAffiliateApplicationsParams\Status|value-of<CampaignListAffiliateApplicationsParams\Status>,
     * }|CampaignListAffiliateApplicationsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AffiliateApplicationListResponse>
     *
     * @throws APIException
     */
    public function listAffiliateApplications(
        string $id,
        array|CampaignListAffiliateApplicationsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CampaignListAffiliateApplicationsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['campaign/%1$s/affiliate-applications', $id],
            query: $parsed,
            options: $options,
            convert: AffiliateApplicationListResponse::class,
        );
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
     * @return BaseResponse<AffiliateApplication>
     *
     * @throws APIException
     */
    public function retrieveAffiliateApplication(
        string $id,
        string $applicationID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['campaign/%1$s/affiliate-applications/%2$s', $id, $applicationID],
            options: $requestOptions,
            convert: AffiliateApplication::class,
        );
    }

    /**
     * @api
     *
     * Decides a pending application. Set `status` to `APPROVED` to enroll the applicant (this creates the participant, or upgrades an existing participant with the same email), or to `DENIED` with an optional `rejectionReason`. A denied applicant may reapply after the program's reapplication cooldown; send an earlier `reapplyAllowedAt` (without `status`) to shorten that wait for one applicant. Provide exactly one of `status` or `reapplyAllowedAt`. Denial-only fields are only valid with `status` set to `DENIED`. Approval is idempotent: repeating it returns the same participant.
     *
     * @param string $id growSurf program ID
     * @param string $applicationID affiliate application ID
     * @param array{
     *   allowImmediateReapply?: bool,
     *   reapplyAllowedAt?: int,
     *   rejectionReason?: string,
     *   reviewNote?: string,
     *   status?: CampaignReviewAffiliateApplicationParams\Status|value-of<CampaignReviewAffiliateApplicationParams\Status>,
     * }|CampaignReviewAffiliateApplicationParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AffiliateApplication>
     *
     * @throws APIException
     */
    public function reviewAffiliateApplication(
        string $id,
        string $applicationID,
        array|CampaignReviewAffiliateApplicationParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CampaignReviewAffiliateApplicationParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['campaign/%1$s/affiliate-applications/%2$s', $id, $applicationID],
            body: (object) $parsed,
            options: $options,
            convert: AffiliateApplication::class,
        );
    }

    /**
     * @api
     *
     * Lists an affiliate program's enrollment invites, newest first.
     *
     * @param string $id growSurf program ID
     * @param array{
     *   limit?: int,
     *   offset?: int,
     *   status?: CampaignListAffiliateInvitesParams\Status|value-of<CampaignListAffiliateInvitesParams\Status>,
     * }|CampaignListAffiliateInvitesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AffiliateInviteListResponse>
     *
     * @throws APIException
     */
    public function listAffiliateInvites(
        string $id,
        array|CampaignListAffiliateInvitesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CampaignListAffiliateInvitesParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['campaign/%1$s/affiliate-invites', $id],
            query: $parsed,
            options: $options,
            convert: AffiliateInviteListResponse::class,
        );
    }

    /**
     * @api
     *
     * Invites someone to join the affiliate program. GrowSurf emails them a single-use accept link; accepting it enrolls them as an approved affiliate without going through the public application. One active invite can exist per email address.
     *
     * @param string $id growSurf program ID
     * @param array{
     *   email: string, firstName?: string, lastName?: string
     * }|CampaignCreateAffiliateInviteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AffiliateInvite>
     *
     * @throws APIException
     */
    public function createAffiliateInvite(
        string $id,
        array|CampaignCreateAffiliateInviteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CampaignCreateAffiliateInviteParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['campaign/%1$s/affiliate-invites', $id],
            body: (object) $parsed,
            options: $options,
            convert: AffiliateInvite::class,
        );
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
     * @return BaseResponse<AffiliateInvite>
     *
     * @throws APIException
     */
    public function revokeAffiliateInvite(
        string $id,
        string $inviteID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['campaign/%1$s/affiliate-invites/%2$s', $id, $inviteID],
            options: $requestOptions,
            convert: AffiliateInvite::class,
        );
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
     * @return BaseResponse<AffiliateInvite>
     *
     * @throws APIException
     */
    public function resendAffiliateInvite(
        string $id,
        string $inviteID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['campaign/%1$s/affiliate-invites/%2$s/resend', $id, $inviteID],
            options: $requestOptions,
            convert: AffiliateInvite::class,
        );
    }
}
