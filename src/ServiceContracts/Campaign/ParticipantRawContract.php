<?php

declare(strict_types=1);

namespace Growsurf\ServiceContracts\Campaign;

use Growsurf\Campaign\Participant\Participant;
use Growsurf\Campaign\Participant\ParticipantAddParams;
use Growsurf\Campaign\Participant\ParticipantCancelDelayedReferralParams;
use Growsurf\Campaign\Participant\ParticipantDeleteParams;
use Growsurf\Campaign\Participant\ParticipantDeleteResponse;
use Growsurf\Campaign\Participant\ParticipantListCommissionsParams;
use Growsurf\Campaign\Participant\ParticipantListPayoutsParams;
use Growsurf\Campaign\Participant\ParticipantListReferralsParams;
use Growsurf\Campaign\Participant\ParticipantListRewardsParams;
use Growsurf\Campaign\Participant\ParticipantListRewardsResponse;
use Growsurf\Campaign\Participant\ParticipantRecordTransactionParams;
use Growsurf\Campaign\Participant\ParticipantRecordTransactionResponse\UnionMember0;
use Growsurf\Campaign\Participant\ParticipantRecordTransactionResponse\UnionMember1;
use Growsurf\Campaign\Participant\ParticipantRefundTransactionParams;
use Growsurf\Campaign\Participant\ParticipantRefundTransactionResponse;
use Growsurf\Campaign\Participant\ParticipantRetrieveParams;
use Growsurf\Campaign\Participant\ParticipantSendInvitesParams;
use Growsurf\Campaign\Participant\ParticipantSendInvitesResponse;
use Growsurf\Campaign\Participant\ParticipantTriggerReferralParams;
use Growsurf\Campaign\Participant\ParticipantTriggerReferralResponse;
use Growsurf\Campaign\Participant\ParticipantUpdateParams;
use Growsurf\Campaign\ParticipantCommissionList;
use Growsurf\Campaign\ParticipantPayoutList;
use Growsurf\Campaign\ReferralList;
use Growsurf\Core\Contracts\BaseResponse;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
interface ParticipantRawContract
{
    /**
     * @api
     *
     * @param string $participantIDOrEmail growSurf participant ID or URL-encoded participant email address
     * @param array<string,mixed>|ParticipantRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Participant>
     *
     * @throws APIException
     */
    public function retrieve(
        string $participantIDOrEmail,
        array|ParticipantRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $participantIDOrEmail path param: GrowSurf participant ID or URL-encoded participant email address
     * @param array<string,mixed>|ParticipantUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Participant>
     *
     * @throws APIException
     */
    public function update(
        string $participantIDOrEmail,
        array|ParticipantUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $participantIDOrEmail growSurf participant ID or URL-encoded participant email address
     * @param array<string,mixed>|ParticipantDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ParticipantDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $participantIDOrEmail,
        array|ParticipantDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param array<string,mixed>|ParticipantAddParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Participant>
     *
     * @throws APIException
     */
    public function add(
        string $id,
        array|ParticipantAddParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $participantIDOrEmail path param: GrowSurf participant ID or URL-encoded participant email address
     * @param array<string,mixed>|ParticipantListCommissionsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ParticipantCommissionList>
     *
     * @throws APIException
     */
    public function listCommissions(
        string $participantIDOrEmail,
        array|ParticipantListCommissionsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $participantIDOrEmail path param: GrowSurf participant ID or URL-encoded participant email address
     * @param array<string,mixed>|ParticipantListPayoutsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ParticipantPayoutList>
     *
     * @throws APIException
     */
    public function listPayouts(
        string $participantIDOrEmail,
        array|ParticipantListPayoutsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $participantIDOrEmail path param: GrowSurf participant ID or URL-encoded participant email address
     * @param array<string,mixed>|ParticipantListReferralsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ReferralList>
     *
     * @throws APIException
     */
    public function listReferrals(
        string $participantIDOrEmail,
        array|ParticipantListReferralsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $participantIDOrEmail path param: GrowSurf participant ID or URL-encoded participant email address
     * @param array<string,mixed>|ParticipantListRewardsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ParticipantListRewardsResponse>
     *
     * @throws APIException
     */
    public function listRewards(
        string $participantIDOrEmail,
        array|ParticipantListRewardsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $participantIDOrEmail path param: GrowSurf participant ID or URL-encoded participant email address
     * @param array<string,mixed>|ParticipantRecordTransactionParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<UnionMember0|UnionMember1>
     *
     * @throws APIException
     */
    public function recordTransaction(
        string $participantIDOrEmail,
        array|ParticipantRecordTransactionParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $participantIDOrEmail path param: GrowSurf participant ID or URL-encoded participant email address
     * @param array<string,mixed>|ParticipantRefundTransactionParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ParticipantRefundTransactionResponse>
     *
     * @throws APIException
     */
    public function refundTransaction(
        string $participantIDOrEmail,
        array|ParticipantRefundTransactionParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $participantIDOrEmail path param: GrowSurf participant ID or URL-encoded participant email address
     * @param array<string,mixed>|ParticipantSendInvitesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ParticipantSendInvitesResponse>
     *
     * @throws APIException
     */
    public function sendInvites(
        string $participantIDOrEmail,
        array|ParticipantSendInvitesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $participantIDOrEmail growSurf participant ID or URL-encoded participant email address
     * @param array<string,mixed>|ParticipantTriggerReferralParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ParticipantTriggerReferralResponse>
     *
     * @throws APIException
     */
    public function triggerReferral(
        string $participantIDOrEmail,
        array|ParticipantTriggerReferralParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $participantIDOrEmail growSurf participant ID or URL-encoded participant email address
     * @param array<string,mixed>|ParticipantCancelDelayedReferralParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ParticipantTriggerReferralResponse>
     *
     * @throws APIException
     */
    public function cancelDelayedReferral(
        string $participantIDOrEmail,
        array|ParticipantCancelDelayedReferralParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
