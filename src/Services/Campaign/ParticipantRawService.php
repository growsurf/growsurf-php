<?php

declare(strict_types=1);

namespace Growsurf\Services\Campaign;

use Growsurf\Campaign\Participant\Participant;
use Growsurf\Campaign\Participant\ParticipantAddParams;
use Growsurf\Campaign\Participant\ParticipantCancelDelayedReferralParams;
use Growsurf\Campaign\Participant\ParticipantDeleteParams;
use Growsurf\Campaign\Participant\ParticipantDeleteResponse;
use Growsurf\Campaign\Participant\ParticipantListCommissionsParams;
use Growsurf\Campaign\Participant\ParticipantListCommissionsParams\Status;
use Growsurf\Campaign\Participant\ParticipantListPayoutsParams;
use Growsurf\Campaign\Participant\ParticipantListReferralsParams;
use Growsurf\Campaign\Participant\ParticipantListReferralsParams\SortBy;
use Growsurf\Campaign\Participant\ParticipantListRewardsParams;
use Growsurf\Campaign\Participant\ParticipantListRewardsResponse;
use Growsurf\Campaign\Participant\ParticipantRecordTransactionParams;
use Growsurf\Campaign\Participant\ParticipantRecordTransactionResponse;
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
use Growsurf\Campaign\Participant\ParticipantUpdateParams\ReferralStatus;
use Growsurf\Campaign\ParticipantCommissionList;
use Growsurf\Campaign\ParticipantPayoutList;
use Growsurf\Campaign\ReferralList;
use Growsurf\Client;
use Growsurf\Core\Contracts\BaseResponse;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\Core\Util;
use Growsurf\RequestOptions;
use Growsurf\ServiceContracts\Campaign\ParticipantRawContract;

/**
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
final class ParticipantRawService implements ParticipantRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieves a single participant by GrowSurf participant ID or email address.
     *
     * @param string $participantIDOrEmail growSurf participant ID or URL-encoded participant email address
     * @param array{id: string}|ParticipantRetrieveParams $params
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
    ): BaseResponse {
        [$parsed, $options] = ParticipantRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['campaign/%1$s/participant/%2$s', $id, $participantIDOrEmail],
            options: $options,
            convert: Participant::class,
        );
    }

    /**
     * @api
     *
     * Updates a participant by GrowSurf participant ID or email address.
     *
     * @param string $participantIDOrEmail path param: GrowSurf participant ID or URL-encoded participant email address
     * @param array{
     *   id: string,
     *   email?: string,
     *   firstName?: string,
     *   lastName?: string,
     *   metadata?: array<string,mixed>,
     *   referralStatus?: ReferralStatus|value-of<ReferralStatus>,
     *   referredBy?: string,
     *   unsubscribed?: bool,
     *   vanityKeys?: list<string>,
     * }|ParticipantUpdateParams $params
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
    ): BaseResponse {
        [$parsed, $options] = ParticipantUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['campaign/%1$s/participant/%2$s', $id, $participantIDOrEmail],
            body: (object) array_diff_key($parsed, array_flip(['id'])),
            options: $options,
            convert: Participant::class,
        );
    }

    /**
     * @api
     *
     * Removes a participant by GrowSurf participant ID or email address.
     *
     * @param string $participantIDOrEmail growSurf participant ID or URL-encoded participant email address
     * @param array{id: string}|ParticipantDeleteParams $params
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
    ): BaseResponse {
        [$parsed, $options] = ParticipantDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['campaign/%1$s/participant/%2$s', $id, $participantIDOrEmail],
            options: $options,
            convert: ParticipantDeleteResponse::class,
        );
    }

    /**
     * @api
     *
     * Adds a new participant to the program. If the email already exists, the existing participant is returned.
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
     *   referralStatus?: ParticipantAddParams\ReferralStatus|value-of<ParticipantAddParams\ReferralStatus>,
     *   referredBy?: string,
     * }|ParticipantAddParams $params
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
    ): BaseResponse {
        [$parsed, $options] = ParticipantAddParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['campaign/%1$s/participant', $id],
            body: (object) $parsed,
            options: $options,
            convert: Participant::class,
        );
    }

    /**
     * @api
     *
     * Retrieves a paged list of commissions earned by a participant.
     *
     * @param string $participantIDOrEmail path param: GrowSurf participant ID or URL-encoded participant email address
     * @param array{
     *   id: string, limit?: int, nextID?: string, status?: Status|value-of<Status>
     * }|ParticipantListCommissionsParams $params
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
    ): BaseResponse {
        [$parsed, $options] = ParticipantListCommissionsParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: [
                'campaign/%1$s/participant/%2$s/commissions', $id, $participantIDOrEmail,
            ],
            query: Util::array_transform_keys($parsed, ['nextID' => 'nextId']),
            options: $options,
            convert: ParticipantCommissionList::class,
        );
    }

    /**
     * @api
     *
     * Retrieves a paged list of payouts that belong to a participant.
     *
     * @param string $participantIDOrEmail path param: GrowSurf participant ID or URL-encoded participant email address
     * @param array{
     *   id: string,
     *   limit?: int,
     *   nextID?: string,
     *   status?: ParticipantListPayoutsParams\Status|value-of<ParticipantListPayoutsParams\Status>,
     * }|ParticipantListPayoutsParams $params
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
    ): BaseResponse {
        [$parsed, $options] = ParticipantListPayoutsParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: [
                'campaign/%1$s/participant/%2$s/payouts', $id, $participantIDOrEmail,
            ],
            query: Util::array_transform_keys($parsed, ['nextID' => 'nextId']),
            options: $options,
            convert: ParticipantPayoutList::class,
        );
    }

    /**
     * @api
     *
     * Retrieves referrals and email invites made by a participant.
     *
     * @param string $participantIDOrEmail path param: GrowSurf participant ID or URL-encoded participant email address
     * @param array{
     *   id: string,
     *   desc?: bool,
     *   email?: string,
     *   firstName?: string,
     *   lastName?: string,
     *   limit?: int,
     *   nextID?: string,
     *   offset?: int,
     *   referralStatus?: \Growsurf\Campaign\Participant\ReferralStatus|value-of<\Growsurf\Campaign\Participant\ReferralStatus>,
     *   sortBy?: value-of<SortBy>,
     * }|ParticipantListReferralsParams $params
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
    ): BaseResponse {
        [$parsed, $options] = ParticipantListReferralsParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: [
                'campaign/%1$s/participant/%2$s/referrals', $id, $participantIDOrEmail,
            ],
            query: Util::array_transform_keys($parsed, ['nextID' => 'nextId']),
            options: $options,
            convert: ReferralList::class,
        );
    }

    /**
     * @api
     *
     * Retrieves a paged list of rewards earned by a participant.
     *
     * @param string $participantIDOrEmail path param: GrowSurf participant ID or URL-encoded participant email address
     * @param array{
     *   id: string, limit?: int, nextID?: string
     * }|ParticipantListRewardsParams $params
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
    ): BaseResponse {
        [$parsed, $options] = ParticipantListRewardsParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: [
                'campaign/%1$s/participant/%2$s/rewards', $id, $participantIDOrEmail,
            ],
            query: Util::array_transform_keys($parsed, ['nextID' => 'nextId']),
            options: $options,
            convert: ParticipantListRewardsResponse::class,
        );
    }

    /**
     * @api
     *
     * Records a sale made by a referred customer and generates affiliate commissions for their referrer when applicable.
     *
     * @param string $participantIDOrEmail path param: GrowSurf participant ID or URL-encoded participant email address
     * @param array{
     *   id: string,
     *   currency: string,
     *   grossAmount: int,
     *   amountCashNet?: int,
     *   amountPaid?: int,
     *   chargeID?: string,
     *   customerID?: string,
     *   description?: string,
     *   externalID?: string,
     *   invoiceID?: string,
     *   invoiceSubtotalExcludingTax?: int,
     *   invoiceTotal?: int,
     *   invoiceTotalExcludingTax?: int,
     *   netAmount?: int,
     *   orderID?: string,
     *   paidAt?: int,
     *   paymentID?: string,
     *   paymentIntentID?: string,
     *   subscriptionID?: string,
     *   taxAmount?: int,
     *   totalTaxAmount?: int,
     *   totalTaxAmounts?: list<array<string,mixed>>,
     *   totalTaxes?: list<array<string,mixed>>,
     *   transactionID?: string,
     * }|ParticipantRecordTransactionParams $params
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
    ): BaseResponse {
        [$parsed, $options] = ParticipantRecordTransactionParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                'campaign/%1$s/participant/%2$s/transaction', $id, $participantIDOrEmail,
            ],
            body: (object) array_diff_key($parsed, array_flip(['id'])),
            options: $options,
            convert: ParticipantRecordTransactionResponse::class,
        );
    }

    /**
     * @api
     *
     * Records an amendment (refund, partial refund, refund cancellation, or chargeback) against a previously recorded transaction and reverses or adjusts the referrer's commission. The inverse of recordTransaction. Commissions already paid out to the affiliate are not clawed back; the amendment is recorded for tax reporting only.
     *
     * @param string $participantIDOrEmail path param: GrowSurf participant ID or URL-encoded participant email address
     * @param array{
     *   id: string,
     *   amendmentType?: ParticipantRefundTransactionParams\AmendmentType|value-of<ParticipantRefundTransactionParams\AmendmentType>,
     *   amount?: int,
     *   amountRefunded?: int,
     *   chargeID?: string,
     *   currency?: string,
     *   description?: string,
     *   externalID?: string,
     *   invoiceID?: string,
     *   orderID?: string,
     *   paymentID?: string,
     *   paymentIntentID?: string,
     *   refundAmount?: int,
     *   refundID?: string,
     *   refundStatus?: string,
     *   transactionID?: string,
     * }|ParticipantRefundTransactionParams $params
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
    ): BaseResponse {
        [$parsed, $options] = ParticipantRefundTransactionParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                'campaign/%1$s/participant/%2$s/transaction/refund',
                $id,
                $participantIDOrEmail,
            ],
            body: (object) array_diff_key($parsed, array_flip(['id'])),
            options: $options,
            convert: ParticipantRefundTransactionResponse::class,
        );
    }

    /**
     * @api
     *
     * Sends email invites on behalf of a participant to a list of email addresses.
     *
     * @param string $participantIDOrEmail path param: GrowSurf participant ID or URL-encoded participant email address
     * @param array{
     *   id: string,
     *   emailAddresses: list<string>,
     *   messageText: string,
     *   subjectText: string,
     * }|ParticipantSendInvitesParams $params
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
    ): BaseResponse {
        [$parsed, $options] = ParticipantSendInvitesParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                'campaign/%1$s/participant/%2$s/invites', $id, $participantIDOrEmail,
            ],
            body: (object) array_diff_key($parsed, array_flip(['id'])),
            options: $options,
            convert: ParticipantSendInvitesResponse::class,
        );
    }

    /**
     * @api
     *
     * Triggers referral credit for an existing referred participant by GrowSurf participant ID or email address.
     *
     * @param string $participantIDOrEmail growSurf participant ID or URL-encoded participant email address
     * @param array{
     *   id: string, delayInDays?: int|null
     * }|ParticipantTriggerReferralParams $params
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
    ): BaseResponse {
        [$parsed, $options] = ParticipantTriggerReferralParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['campaign/%1$s/participant/%2$s/ref', $id, $participantIDOrEmail],
            body: (object) array_diff_key($parsed, array_flip(['id'])),
            options: $options,
            convert: ParticipantTriggerReferralResponse::class,
        );
    }

    /**
     * @api
     *
     * Cancels a pending delayed referral trigger for a participant by GrowSurf participant ID or email address.
     *
     * @param string $participantIDOrEmail growSurf participant ID or URL-encoded participant email address
     * @param array{id: string}|ParticipantCancelDelayedReferralParams $params
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
    ): BaseResponse {
        [$parsed, $options] = ParticipantCancelDelayedReferralParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['campaign/%1$s/participant/%2$s/ref', $id, $participantIDOrEmail],
            options: $options,
            convert: ParticipantTriggerReferralResponse::class,
        );
    }
}
