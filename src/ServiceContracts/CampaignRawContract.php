<?php

declare(strict_types=1);

namespace Growsurf\ServiceContracts;

use Growsurf\Campaign\AffiliateApplication;
use Growsurf\Campaign\AffiliateApplicationListResponse;
use Growsurf\Campaign\AffiliateInvite;
use Growsurf\Campaign\AffiliateInviteListResponse;
use Growsurf\Campaign\Campaign;
use Growsurf\Campaign\CampaignCreateAffiliateInviteParams;
use Growsurf\Campaign\CampaignCreateMobileParticipantTokenParams;
use Growsurf\Campaign\CampaignCreateParams;
use Growsurf\Campaign\CampaignGetAnalyticsResponse;
use Growsurf\Campaign\CampaignListAffiliateApplicationsParams;
use Growsurf\Campaign\CampaignListAffiliateInvitesParams;
use Growsurf\Campaign\CampaignListCommissionsParams;
use Growsurf\Campaign\CampaignListLeaderboardParams;
use Growsurf\Campaign\CampaignListParticipantsParams;
use Growsurf\Campaign\CampaignListPayoutsParams;
use Growsurf\Campaign\CampaignListReferralsParams;
use Growsurf\Campaign\CampaignListResponse;
use Growsurf\Campaign\CampaignNewMobileParticipantTokenResponse;
use Growsurf\Campaign\CampaignRetrieveAnalyticsParams;
use Growsurf\Campaign\CampaignReviewAffiliateApplicationParams;
use Growsurf\Campaign\CampaignUpdateParams;
use Growsurf\Campaign\ParticipantCommissionList;
use Growsurf\Campaign\ParticipantList;
use Growsurf\Campaign\ParticipantPayoutList;
use Growsurf\Campaign\ReferralList;
use Growsurf\Core\Contracts\BaseResponse;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
interface CampaignRawContract
{
    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CampaignListResponse>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|CampaignCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Campaign>
     *
     * @throws APIException
     */
    public function create(
        array|CampaignCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param array<string,mixed>|CampaignUpdateParams $params
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
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param array<string,mixed>|CampaignCreateMobileParticipantTokenParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param array<string,mixed>|CampaignListCommissionsParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param array<string,mixed>|CampaignListLeaderboardParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param array<string,mixed>|CampaignListParticipantsParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param array<string,mixed>|CampaignListPayoutsParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param array<string,mixed>|CampaignListReferralsParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param array<string,mixed>|CampaignRetrieveAnalyticsParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param array<string,mixed>|CampaignListAffiliateApplicationsParams $params
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
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param string $applicationID affiliate application ID
     * @param array<string,mixed>|CampaignReviewAffiliateApplicationParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param array<string,mixed>|CampaignListAffiliateInvitesParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param array<string,mixed>|CampaignCreateAffiliateInviteParams $params
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
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;
}
