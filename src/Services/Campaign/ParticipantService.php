<?php

declare(strict_types=1);

namespace Growsurf\Services\Campaign;

use Growsurf\Campaign\Participant\Participant;
use Growsurf\Campaign\Participant\ParticipantDeleteResponse;
use Growsurf\Campaign\Participant\ParticipantListCommissionsParams\Status;
use Growsurf\Campaign\Participant\ParticipantListReferralsParams\SortBy;
use Growsurf\Campaign\Participant\ParticipantListRewardsResponse;
use Growsurf\Campaign\Participant\ParticipantRecordTransactionResponse\UnionMember0;
use Growsurf\Campaign\Participant\ParticipantRecordTransactionResponse\UnionMember1;
use Growsurf\Campaign\Participant\ParticipantSendInvitesResponse;
use Growsurf\Campaign\Participant\ParticipantTriggerReferralResponse;
use Growsurf\Campaign\Participant\ParticipantUpdateParams\ReferralStatus;
use Growsurf\Campaign\ParticipantCommissionList;
use Growsurf\Campaign\ParticipantPayoutList;
use Growsurf\Campaign\ReferralList;
use Growsurf\Client;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\Core\Util;
use Growsurf\RequestOptions;
use Growsurf\ServiceContracts\Campaign\ParticipantContract;

/**
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
final class ParticipantService implements ParticipantContract
{
    /**
     * @api
     */
    public ParticipantRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ParticipantRawService($client);
    }

    /**
     * @api
     *
     * Retrieves a single participant by GrowSurf participant ID or email address.
     *
     * @param string $participantIDOrEmail growSurf participant ID or URL-encoded participant email address
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $participantIDOrEmail,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): Participant {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($participantIDOrEmail, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Updates a participant by GrowSurf participant ID or email address.
     *
     * @param string $participantIDOrEmail path param: GrowSurf participant ID or URL-encoded participant email address
     * @param string $id path param: GrowSurf program ID
     * @param string $email Body param
     * @param string $firstName Body param
     * @param string $lastName Body param
     * @param array<string,mixed> $metadata body param: Shallow custom metadata object
     * @param ReferralStatus|value-of<ReferralStatus> $referralStatus Body param
     * @param string $referredBy Body param
     * @param bool $unsubscribed Body param
     * @param list<string> $vanityKeys Body param
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $participantIDOrEmail,
        string $id,
        ?string $email = null,
        ?string $firstName = null,
        ?string $lastName = null,
        ?array $metadata = null,
        ReferralStatus|string|null $referralStatus = null,
        ?string $referredBy = null,
        ?bool $unsubscribed = null,
        ?array $vanityKeys = null,
        RequestOptions|array|null $requestOptions = null,
    ): Participant {
        $params = Util::removeNulls(
            [
                'id' => $id,
                'email' => $email,
                'firstName' => $firstName,
                'lastName' => $lastName,
                'metadata' => $metadata,
                'referralStatus' => $referralStatus,
                'referredBy' => $referredBy,
                'unsubscribed' => $unsubscribed,
                'vanityKeys' => $vanityKeys,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($participantIDOrEmail, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Removes a participant by GrowSurf participant ID or email address.
     *
     * @param string $participantIDOrEmail growSurf participant ID or URL-encoded participant email address
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $participantIDOrEmail,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): ParticipantDeleteResponse {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($participantIDOrEmail, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Adds a new participant to the program. If the email already exists, the existing participant is returned.
     *
     * @param string $id growSurf program ID
     * @param array<string,mixed> $metadata shallow custom metadata object
     * @param string $mobileInstanceID Optional app-install scoped identifier for native mobile anti-fraud. Recommended for mobile participant creation and mobile participant token flows.
     * @param \Growsurf\Campaign\Participant\ParticipantAddParams\ReferralStatus|value-of<\Growsurf\Campaign\Participant\ParticipantAddParams\ReferralStatus> $referralStatus
     * @param string $referredBy referrer participant ID or email address
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function add(
        string $id,
        string $email,
        ?string $fingerprint = null,
        ?string $firstName = null,
        ?string $ipAddress = null,
        ?string $lastName = null,
        ?array $metadata = null,
        ?string $mobileInstanceID = null,
        \Growsurf\Campaign\Participant\ParticipantAddParams\ReferralStatus|string|null $referralStatus = null,
        ?string $referredBy = null,
        RequestOptions|array|null $requestOptions = null,
    ): Participant {
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
        $response = $this->raw->add($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieves a paged list of commissions earned by a participant.
     *
     * @param string $participantIDOrEmail path param: GrowSurf participant ID or URL-encoded participant email address
     * @param string $id path param: GrowSurf program ID
     * @param int $limit Query param: Number of results to return. Maximum 100.
     * @param string $nextID query param: ID to start the next paged result set with
     * @param Status|value-of<Status> $status query param: Participant commission status
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listCommissions(
        string $participantIDOrEmail,
        string $id,
        int $limit = 10,
        ?string $nextID = null,
        Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): ParticipantCommissionList {
        $params = Util::removeNulls(
            ['id' => $id, 'limit' => $limit, 'nextID' => $nextID, 'status' => $status]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listCommissions($participantIDOrEmail, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieves a paged list of payouts that belong to a participant.
     *
     * @param string $participantIDOrEmail path param: GrowSurf participant ID or URL-encoded participant email address
     * @param string $id path param: GrowSurf program ID
     * @param int $limit Query param: Number of results to return. Maximum 100.
     * @param string $nextID query param: ID to start the next paged result set with
     * @param \Growsurf\Campaign\Participant\ParticipantListPayoutsParams\Status|value-of<\Growsurf\Campaign\Participant\ParticipantListPayoutsParams\Status> $status query param: Participant payout status
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listPayouts(
        string $participantIDOrEmail,
        string $id,
        int $limit = 10,
        ?string $nextID = null,
        \Growsurf\Campaign\Participant\ParticipantListPayoutsParams\Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): ParticipantPayoutList {
        $params = Util::removeNulls(
            ['id' => $id, 'limit' => $limit, 'nextID' => $nextID, 'status' => $status]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listPayouts($participantIDOrEmail, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieves referrals and email invites made by a participant.
     *
     * @param string $participantIDOrEmail path param: GrowSurf participant ID or URL-encoded participant email address
     * @param string $id path param: GrowSurf program ID
     * @param bool $desc query param: Return results in descending order when true
     * @param string $email query param: URL-encoded email value to filter referral results
     * @param string $firstName query param: First name value to filter results
     * @param string $lastName query param: Last name value to filter results
     * @param int $limit Query param: Number of results to return. Maximum 100.
     * @param string $nextID query param: ID to start the next paged result set with
     * @param int $offset query param: Offset number used to skip through a result set
     * @param \Growsurf\Campaign\Participant\ReferralStatus|value-of<\Growsurf\Campaign\Participant\ReferralStatus> $referralStatus Query param
     * @param SortBy|value-of<SortBy> $sortBy query param: Field used to sort referral results
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listReferrals(
        string $participantIDOrEmail,
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
                'id' => $id,
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
        $response = $this->raw->listReferrals($participantIDOrEmail, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieves a paged list of rewards earned by a participant.
     *
     * @param string $participantIDOrEmail path param: GrowSurf participant ID or URL-encoded participant email address
     * @param string $id path param: GrowSurf program ID
     * @param int $limit Query param: Number of results to return. Maximum 100.
     * @param string $nextID query param: ID to start the next paged result set with
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listRewards(
        string $participantIDOrEmail,
        string $id,
        int $limit = 10,
        ?string $nextID = null,
        RequestOptions|array|null $requestOptions = null,
    ): ParticipantListRewardsResponse {
        $params = Util::removeNulls(
            ['id' => $id, 'limit' => $limit, 'nextID' => $nextID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listRewards($participantIDOrEmail, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Records a sale made by a referred customer and generates affiliate commissions for their referrer when applicable.
     *
     * @param string $participantIDOrEmail path param: GrowSurf participant ID or URL-encoded participant email address
     * @param string $id path param: GrowSurf program ID
     * @param string $currency Body param
     * @param int $grossAmount Body param
     * @param int $amountCashNet Body param
     * @param int $amountPaid Body param
     * @param string $chargeID Body param
     * @param string $customerID Body param
     * @param string $description Body param
     * @param string $externalID Body param
     * @param string $invoiceID Body param
     * @param int $invoiceSubtotalExcludingTax Body param
     * @param int $invoiceTotal Body param
     * @param int $invoiceTotalExcludingTax Body param
     * @param int $netAmount Body param
     * @param string $orderID Body param
     * @param int $paidAt Body param
     * @param string $paymentID Body param
     * @param string $paymentIntentID Body param
     * @param string $subscriptionID Body param
     * @param int $taxAmount Body param
     * @param int $totalTaxAmount Body param
     * @param list<array<string,mixed>> $totalTaxAmounts Body param
     * @param list<array<string,mixed>> $totalTaxes Body param
     * @param string $transactionID Body param
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function recordTransaction(
        string $participantIDOrEmail,
        string $id,
        string $currency,
        int $grossAmount,
        ?int $amountCashNet = null,
        ?int $amountPaid = null,
        ?string $chargeID = null,
        ?string $customerID = null,
        ?string $description = null,
        ?string $externalID = null,
        ?string $invoiceID = null,
        ?int $invoiceSubtotalExcludingTax = null,
        ?int $invoiceTotal = null,
        ?int $invoiceTotalExcludingTax = null,
        ?int $netAmount = null,
        ?string $orderID = null,
        ?int $paidAt = null,
        ?string $paymentID = null,
        ?string $paymentIntentID = null,
        ?string $subscriptionID = null,
        ?int $taxAmount = null,
        ?int $totalTaxAmount = null,
        ?array $totalTaxAmounts = null,
        ?array $totalTaxes = null,
        ?string $transactionID = null,
        RequestOptions|array|null $requestOptions = null,
    ): UnionMember0|UnionMember1 {
        $params = Util::removeNulls(
            [
                'id' => $id,
                'currency' => $currency,
                'grossAmount' => $grossAmount,
                'amountCashNet' => $amountCashNet,
                'amountPaid' => $amountPaid,
                'chargeID' => $chargeID,
                'customerID' => $customerID,
                'description' => $description,
                'externalID' => $externalID,
                'invoiceID' => $invoiceID,
                'invoiceSubtotalExcludingTax' => $invoiceSubtotalExcludingTax,
                'invoiceTotal' => $invoiceTotal,
                'invoiceTotalExcludingTax' => $invoiceTotalExcludingTax,
                'netAmount' => $netAmount,
                'orderID' => $orderID,
                'paidAt' => $paidAt,
                'paymentID' => $paymentID,
                'paymentIntentID' => $paymentIntentID,
                'subscriptionID' => $subscriptionID,
                'taxAmount' => $taxAmount,
                'totalTaxAmount' => $totalTaxAmount,
                'totalTaxAmounts' => $totalTaxAmounts,
                'totalTaxes' => $totalTaxes,
                'transactionID' => $transactionID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->recordTransaction($participantIDOrEmail, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Sends email invites on behalf of a participant to a list of email addresses.
     *
     * @param string $participantIDOrEmail path param: GrowSurf participant ID or URL-encoded participant email address
     * @param string $id path param: GrowSurf program ID
     * @param list<string> $emailAddresses Body param
     * @param string $messageText Body param
     * @param string $subjectText Body param
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function sendInvites(
        string $participantIDOrEmail,
        string $id,
        array $emailAddresses,
        string $messageText,
        string $subjectText,
        RequestOptions|array|null $requestOptions = null,
    ): ParticipantSendInvitesResponse {
        $params = Util::removeNulls(
            [
                'id' => $id,
                'emailAddresses' => $emailAddresses,
                'messageText' => $messageText,
                'subjectText' => $subjectText,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->sendInvites($participantIDOrEmail, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Triggers referral credit for an existing referred participant by GrowSurf participant ID or email address.
     *
     * @param string $participantIDOrEmail growSurf participant ID or URL-encoded participant email address
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function triggerReferral(
        string $participantIDOrEmail,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): ParticipantTriggerReferralResponse {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->triggerReferral($participantIDOrEmail, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
