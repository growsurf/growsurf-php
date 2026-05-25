<?php

declare(strict_types=1);

namespace Growsurf\Services;

use Growsurf\Campaign\Campaign;
use Growsurf\Campaign\CampaignCreateMobileParticipantTokenParams\ReferralStatus;
use Growsurf\Campaign\CampaignGetAnalyticsResponse;
use Growsurf\Campaign\CampaignListCommissionsParams\Status;
use Growsurf\Campaign\CampaignListLeaderboardParams\LeaderboardType;
use Growsurf\Campaign\CampaignListReferralsParams\SortBy;
use Growsurf\Campaign\CampaignListResponse;
use Growsurf\Campaign\CampaignNewMobileParticipantTokenResponse;
use Growsurf\Campaign\ParticipantCommissionList;
use Growsurf\Campaign\ParticipantList;
use Growsurf\Campaign\ParticipantPayoutList;
use Growsurf\Campaign\ReferralList;
use Growsurf\Client;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\Core\Util;
use Growsurf\RequestOptions;
use Growsurf\ServiceContracts\CampaignContract;
use Growsurf\Services\Campaign\CommissionService;
use Growsurf\Services\Campaign\ParticipantService;
use Growsurf\Services\Campaign\RewardService;

/**
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
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
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CampaignRawService($client);
        $this->participant = new ParticipantService($client);
        $this->reward = new RewardService($client);
        $this->commission = new CommissionService($client);
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
     * Retrieves a paged list of all participant commissions in an affiliate program.
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
     * Retrieves a paged list of all participant payouts in an affiliate program.
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
     * Retrieves analytics for a program.
     *
     * @param string $id growSurf program ID
     * @param int $days Last number of days to retrieve analytics for. Defaults to 365. Maximum 1825.
     * @param int $endDate End date of the analytics timeframe as a Unix timestamp in milliseconds. Required if `days` is not set.
     * @param int $startDate Start date of the analytics timeframe as a Unix timestamp in milliseconds. Required if `days` is not set.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveAnalytics(
        string $id,
        int $days = 365,
        ?int $endDate = null,
        ?int $startDate = null,
        RequestOptions|array|null $requestOptions = null,
    ): CampaignGetAnalyticsResponse {
        $params = Util::removeNulls(
            ['days' => $days, 'endDate' => $endDate, 'startDate' => $startDate]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveAnalytics($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
