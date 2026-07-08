<?php

declare(strict_types=1);

namespace Growsurf\Services\Campaign;

use Growsurf\Campaign\Participant\Participant;
use Growsurf\Campaign\Participant\ParticipantBulkDeleteResponse;
use Growsurf\Campaign\Participant\ParticipantDeleteResponse;
use Growsurf\Campaign\Participant\ParticipantEmailResponse;
use Growsurf\Campaign\Participant\ParticipantGetAnalyticsResponse;
use Growsurf\Campaign\Participant\ParticipantListActivityLogsResponse;
use Growsurf\Campaign\Participant\ParticipantListCommissionsParams\Status;
use Growsurf\Campaign\Participant\ParticipantListReferralsParams\SortBy;
use Growsurf\Campaign\Participant\ParticipantListRewardsResponse;
use Growsurf\Campaign\Participant\ParticipantRecordTransactionResponse\UnionMember0;
use Growsurf\Campaign\Participant\ParticipantRecordTransactionResponse\UnionMember1;
use Growsurf\Campaign\Participant\ParticipantRefundTransactionParams\AmendmentType;
use Growsurf\Campaign\Participant\ParticipantRefundTransactionResponse;
use Growsurf\Campaign\Participant\ParticipantRetrieveAnalyticsParams\Interval;
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
     * @param string $notes body param: Freeform internal notes about the participant (internal only, never exposed to participants)
     * @param string $paypalEmail body param: The participant's PayPal email address, used for affiliate payouts
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
        ?string $notes = null,
        ?string $paypalEmail = null,
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
                'notes' => $notes,
                'paypalEmail' => $paypalEmail,
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
     * Deletes a list of participants from a program in one request. Each entry in `participants` is a GrowSurf participant ID or an email address (mixed lists are allowed). Up to `200` entries per request — chunk larger lists across multiple calls. The response reports a per-row `status` for every submitted entry, so a `200` can include rows that were `NOT_FOUND` or failed. Deletion is permanent and removes the participants' referrals, rewards, commissions, and payout records.
     *
     * @param string $id growSurf program ID
     * @param list<string> $participants GrowSurf participant IDs and/or email addresses to delete. Mixed entries are allowed.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function bulkDelete(
        string $id,
        array $participants,
        RequestOptions|array|null $requestOptions = null,
    ): ParticipantBulkDeleteResponse {
        $params = Util::removeNulls(['participants' => $participants]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->bulkDelete($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Adds a new participant to the program. If the email already exists, the existing participant is returned.
     *
     * @param string $id growSurf program ID
     * @param array<string,mixed> $metadata shallow custom metadata object
     * @param string $mobileInstanceID Optional app-install scoped identifier for native mobile anti-fraud. Recommended for mobile participant creation and mobile participant token flows. The official mobile SDKs generate this as a lowercase UUID.
     * @param \Growsurf\Campaign\Participant\ParticipantAddParams\ReferralStatus|value-of<\Growsurf\Campaign\Participant\ParticipantAddParams\ReferralStatus> $referralStatus The referral credit status. Only meaningful when `referredBy` resolves to a referrer. When omitted, it is derived from the program's referral trigger (`CREDIT_AWARDED`, `CREDIT_PENDING`, or `CREDIT_EXPIRED`); left unset when no referrer resolves.
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
     * At least one transaction identifier is required: one of `externalId`, `transactionId`, `orderId`, `paymentId`, `invoiceId`, `paymentIntentId`, or `chargeId`. `customerId` and `subscriptionId` do not count, since they identify the customer or subscription rather than the specific transaction. Without an identifier, resending the same sale creates a duplicate commission and double-pays the referrer; the server rejects such requests with HTTP 400.
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
     * Records an amendment (refund, partial refund, refund cancellation, or chargeback) against a previously recorded transaction and reverses or adjusts the referrer's commission. The inverse of recordTransaction. Commissions already paid out to the affiliate are not clawed back; the amendment is recorded for tax reporting only.
     *
     * @param string $participantIDOrEmail path param: GrowSurf participant ID or URL-encoded participant email address
     * @param string $id path param: GrowSurf program ID
     * @param AmendmentType|value-of<AmendmentType> $amendmentType body param: REFUND covers full refunds, partial refunds, and refund cancellations; CHARGEBACK is always a full reversal
     * @param int $amount body param: Original sale gross (minor units). Optional — the value stored when the transaction was recorded is used when available; only needed for partial refunds of older records.
     * @param int $amountRefunded body param: Cumulative amount refunded so far, in the currency's minor unit. Omit for a full refund. For a partial refund send the running total, not the per-refund delta.
     * @param string $chargeID Body param
     * @param string $currency body param: 3-letter ISO currency. Optional — resolved from the original commission when available.
     * @param string $description Body param
     * @param string $externalID Body param
     * @param string $invoiceID Body param
     * @param string $orderID Body param
     * @param string $paymentID Body param
     * @param string $paymentIntentID Body param
     * @param int $refundAmount body param: The per-refund delta (minor units). Optional bookkeeping field.
     * @param string $refundID body param: Stable per-refund identifier. Recommended for partial refunds so repeated calls stay idempotent.
     * @param string $refundStatus body param: Refund status. Send "canceled" with a lowered amountRefunded to restore a previously reduced commission.
     * @param string $transactionID Body param
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function refundTransaction(
        string $participantIDOrEmail,
        string $id,
        AmendmentType|string $amendmentType = 'REFUND',
        ?int $amount = null,
        ?int $amountRefunded = null,
        ?string $chargeID = null,
        ?string $currency = null,
        ?string $description = null,
        ?string $externalID = null,
        ?string $invoiceID = null,
        ?string $orderID = null,
        ?string $paymentID = null,
        ?string $paymentIntentID = null,
        ?int $refundAmount = null,
        ?string $refundID = null,
        ?string $refundStatus = null,
        ?string $transactionID = null,
        RequestOptions|array|null $requestOptions = null,
    ): ParticipantRefundTransactionResponse {
        $params = Util::removeNulls(
            [
                'id' => $id,
                'amendmentType' => $amendmentType,
                'amount' => $amount,
                'amountRefunded' => $amountRefunded,
                'chargeID' => $chargeID,
                'currency' => $currency,
                'description' => $description,
                'externalID' => $externalID,
                'invoiceID' => $invoiceID,
                'orderID' => $orderID,
                'paymentID' => $paymentID,
                'paymentIntentID' => $paymentIntentID,
                'refundAmount' => $refundAmount,
                'refundID' => $refundID,
                'refundStatus' => $refundStatus,
                'transactionID' => $transactionID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->refundTransaction($participantIDOrEmail, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Sends email invites on behalf of a participant to a list of email addresses. Sending invites via the API requires a verified custom email domain on the program; the request fails until one is verified.
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
     * @param string $participantIDOrEmail path param: GrowSurf participant ID or URL-encoded participant email address
     * @param string $id path param: GrowSurf program ID
     * @param int $delayInDays Body param: Number of whole days to hold referral credit before it is awarded. Useful for honoring a refund window before crediting a referrer. Omit this field to award credit immediately. The credit is awarded automatically once the delay elapses, and can be cancelled before then with the Cancel delayed referral trigger request.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function triggerReferral(
        string $participantIDOrEmail,
        string $id,
        ?int $delayInDays = null,
        RequestOptions|array|null $requestOptions = null,
    ): ParticipantTriggerReferralResponse {
        $params = Util::removeNulls(['id' => $id, 'delayInDays' => $delayInDays]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->triggerReferral($participantIDOrEmail, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Cancels a pending delayed referral trigger for a participant by GrowSurf participant ID or email address.
     *
     * @param string $participantIDOrEmail growSurf participant ID or URL-encoded participant email address
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancelDelayedReferral(
        string $participantIDOrEmail,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): ParticipantTriggerReferralResponse {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->cancelDelayedReferral($participantIDOrEmail, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Sends an email to a participant. Provide EITHER `emailType` to trigger one of the program's configured email templates, OR `subject` + `body` for a free-form email. Free-form emails are sent with the same compliance handling (company name, postal address, and an unsubscribe link are added automatically, and unsubscribed participants are suppressed). Sending requires the account to be verified by the GrowSurf team. Requires a verified custom email domain on the program (set up in Campaign Editor > 3. Emails > Email Settings). Returns `400` until one is verified. The email is accepted for delivery.
     *
     * @param string $participantIDOrEmail path param: GrowSurf participant ID or URL-encoded participant email address
     * @param string $id path param: GrowSurf program ID
     * @param string $body body param: HTML body for a free-form email. You can personalize it with dynamic text, inserting `{{...}}` tokens like `{{firstName}}` or `{{shareUrl}}`. See [Guide to using dynamic text in GrowSurf emails](https://support.growsurf.com/article/213-guide-to-using-dynamic-text-in-growsurf-emails).
     * @param string $emailType body param: The program email template to trigger (template mode). Send the camelCase email-type key; the available types depend on the program type, and `isEnabled` only controls automatic sends. System/transactional types (login link, PayPal confirmation, tax) and the invite email cannot be sent. Referral programs: welcomeNonReferred, referralLinkViewedFirstTime, referralLinkUsed, referredSignup, welcomeReferred, goalAchieved, campaignEndedWinners, campaignEndedNonWinners, progressUpdateMonthly. Affiliate programs: welcomeNonReferred, referralLinkViewedFirstTime, referredSignup, commissionGenerated, commissionAdjusted, payoutPending, payoutSentSuccess, progressUpdateMonthly.
     * @param string $preheader body param: Optional preheader text for a free-form email
     * @param string $subject body param: Subject line for a free-form email. Supports dynamic text (`{{...}}` tokens), the same as the body.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function email(
        string $participantIDOrEmail,
        string $id,
        ?string $body = null,
        ?string $emailType = null,
        ?string $preheader = null,
        ?string $subject = null,
        RequestOptions|array|null $requestOptions = null,
    ): ParticipantEmailResponse {
        $params = Util::removeNulls(
            [
                'id' => $id,
                'body' => $body,
                'emailType' => $emailType,
                'preheader' => $preheader,
                'subject' => $subject,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->email($participantIDOrEmail, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieves analytics for a single participant — all-time engagement counters, leaderboard ranks, and per-channel share counts (plus affiliate money metrics for affiliate programs). Useful for segmenting and re-engaging participants.
     *
     * @param string $participantIDOrEmail growSurf participant ID or URL-encoded participant email address
     * @param string $id growSurf program ID
     * @param int $days Last number of days to retrieve analytics for. Defaults to 365. Maximum 1825.
     * @param int $endDate End date of the analytics timeframe as a Unix timestamp in milliseconds. Required if `days` is not set.
     * @param string $include Set to `series` to also return this participant's own activity per period.
     * @param Interval|value-of<Interval> $interval Bucket size for the `series` (only used with `include=series`). Defaults to `day`.
     * @param int $startDate Start date of the analytics timeframe as a Unix timestamp in milliseconds. Required if `days` is not set.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveAnalytics(
        string $participantIDOrEmail,
        string $id,
        int $days = 365,
        ?int $endDate = null,
        ?string $include = null,
        Interval|string|null $interval = null,
        ?int $startDate = null,
        RequestOptions|array|null $requestOptions = null,
    ): ParticipantGetAnalyticsResponse {
        $params = Util::removeNulls(
            [
                'id' => $id,
                'days' => $days,
                'endDate' => $endDate,
                'include' => $include,
                'interval' => $interval,
                'startDate' => $startDate,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveAnalytics($participantIDOrEmail, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns a participant's activity logs, most recent first (offset/limit paginated).
     *
     * @param string $participantIDOrEmail path param: GrowSurf participant ID or URL-encoded participant email address
     * @param string $id path param: GrowSurf program ID
     * @param int $limit query param: Number of logs to return (1–100, default 20)
     * @param int $offset query param: Number of logs to skip
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listActivityLogs(
        string $participantIDOrEmail,
        string $id,
        int $limit = 20,
        ?int $offset = null,
        RequestOptions|array|null $requestOptions = null,
    ): ParticipantListActivityLogsResponse {
        $params = Util::removeNulls(
            ['id' => $id, 'limit' => $limit, 'offset' => $offset]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listActivityLogs($participantIDOrEmail, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
