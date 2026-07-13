<?php

declare(strict_types=1);

namespace Growsurf\Services;

use Growsurf\Campaign\Campaign;
use Growsurf\Campaign\CampaignCreateMobileParticipantTokenParams;
use Growsurf\Campaign\CampaignCreateMobileParticipantTokenParams\ReferralStatus;
use Growsurf\Campaign\CampaignCreateParams;
use Growsurf\Campaign\CampaignCreateParams\Type;
use Growsurf\Campaign\CampaignGetAnalyticsResponse;
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
     * Creates a new program pre-populated with type-appropriate defaults, plus any optional inline rewards. The new program is created in `DRAFT` status and owned by the API key's bound team. Requires the team owner's verified email.
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
     * Retrieves a paged list of all participant commissions in an affiliate program.
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
     * Retrieves a paged list of all participant payouts in an affiliate program.
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
     * Retrieves analytics for a program.
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
}
