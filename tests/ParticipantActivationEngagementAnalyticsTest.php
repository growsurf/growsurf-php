<?php

declare(strict_types=1);

namespace Tests;

use Growsurf\Campaign\CampaignEngagementAnalytics;
use Growsurf\Campaign\CampaignRetrieveAnalyticsParams;
use Growsurf\Campaign\Participant\ParticipantActivationAnalytics\Milestones;
use Growsurf\Campaign\Participant\ParticipantGetAnalyticsResponse;
use Growsurf\Campaign\Participant\ParticipantGetAnalyticsResponse\Series as ParticipantSeries;
use Growsurf\Client as GrowsurfClient;
use Growsurf\Core\Util;
use Growsurf\Services\CampaignService;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Mock\Client;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 */
#[CoversNothing]
final class ParticipantActivationEngagementAnalyticsTest extends TestCase
{
    #[Test]
    public function itPreservesLegacyCallsAndSendsExactOptInQueries(): void
    {
        $transporter = new Client;
        $transporter->addResponse($this->jsonResponse($this->campaignAnalyticsFixture()));
        $transporter->addResponse($this->jsonResponse($this->campaignAnalyticsFixture(
            engagement: $this->engagementFixture()
        )));
        $transporter->addResponse($this->jsonResponse($this->activationFixture()));
        $transporter->addResponse($this->jsonResponse($this->participantAnalyticsFixture()));

        $client = new GrowsurfClient(
            apiKey: 'My API Key',
            baseUrl: 'http://localhost',
            requestOptions: ['transporter' => $transporter],
        );

        $legacy = $client->campaign->retrieveAnalytics('program_123');
        $engagement = $client->campaign->retrieveAnalytics(
            'program_123',
            include: 'engagement',
            platform: 'IOS',
            timezone: 'America/New_York',
        );
        $activation = $client->campaign->retrieveActivationAnalytics(
            'program_123',
            cohortFrom: 1_767_225_600_000,
            cohortTo: 1_769_904_000_000,
            cohortInterval: 'week',
            observationWindowDays: 7,
            timezone: 'America/New_York',
        );
        $participant = $client->campaign->participant->retrieveAnalytics(
            'person@example.com',
            id: 'program_123',
            include: 'activation,series',
        );

        self::assertArrayNotHasKey('engagement', $legacy->jsonSerialize());
        self::assertInstanceOf(CampaignEngagementAnalytics::class, $engagement->engagement);
        self::assertNull($engagement->engagement->coverageStartAt);
        self::assertSame('PARTIAL', $engagement->engagement->state);
        self::assertSame('PRE_COVERAGE', $engagement->engagement->reason);
        self::assertNull($activation->aggregate->strictStages);
        self::assertSame('UNAVAILABLE', $activation->aggregate->state);
        self::assertSame('PRE_COVERAGE', $activation->aggregate->reason);

        self::assertNotNull($participant->activation);
        $participantActivation = $participant->activation;
        self::assertSame('PARTIAL', $participantActivation->state);
        self::assertSame('PRE_COVERAGE', $participantActivation->reason);
        self::assertNull($participantActivation->milestones->firstPortalViewedAt);
        self::assertArrayHasKey(
            'firstPortalViewedAt',
            $participantActivation->milestones->jsonSerialize(),
        );
        self::assertNotNull($participant->series);
        self::assertCount(1, $participant->series);
        $seriesPoint = $participant->series[0];
        self::assertNull($seriesPoint->portalViews);
        self::assertArrayHasKey('portalViews', $seriesPoint->jsonSerialize());

        $requests = $transporter->getRequests();
        self::assertCount(4, $requests);
        self::assertSame('/campaign/program_123/analytics', $requests[0]->getUri()->getPath());
        self::assertSame('days=365', $requests[0]->getUri()->getQuery());
        self::assertSame(
            ['days' => '365', 'include' => 'engagement', 'platform' => 'IOS', 'timezone' => 'America/New_York'],
            $this->query($requests[1]->getUri()->getQuery()),
        );
        self::assertSame('/campaign/program_123/analytics/activation', $requests[2]->getUri()->getPath());
        self::assertSame(
            [
                'cohortFrom' => '1767225600000',
                'cohortTo' => '1769904000000',
                'cohortInterval' => 'week',
                'observationWindowDays' => '7',
                'timezone' => 'America/New_York',
            ],
            $this->query($requests[2]->getUri()->getQuery()),
        );
        self::assertSame(
            '/campaign/program_123/participant/person%40example.com/analytics',
            $requests[3]->getUri()->getPath(),
        );
        self::assertSame(
            ['days' => '365', 'include' => 'activation,series'],
            $this->query($requests[3]->getUri()->getQuery()),
        );
    }

    #[Test]
    public function itExposesCoveredMilestonesWithoutLegacyPortalNames(): void
    {
        $response = ParticipantGetAnalyticsResponse::fromArray(
            $this->participantAnalyticsFixture(covered: true)
        );

        self::assertNotNull($response->activation);
        $activation = $response->activation;
        self::assertSame(1_767_398_400_000, $activation->milestones->firstPortalViewedAt);
        self::assertSame('copyRefLink', $activation->milestones->firstShareChannel);

        $properties = array_keys(get_class_vars(Milestones::class));
        self::assertContains('firstPortalViewedAt', $properties);
        self::assertNotContains('portalOpenedAt', $properties);
        self::assertNotContains('firstWindowOpenedAt', $properties);
    }

    #[Test]
    public function itAppendsNewOptionalParametersWithoutShiftingExistingPositions(): void
    {
        self::assertSame(
            ['days', 'endDate', 'include', 'interval', 'startDate'],
            array_slice($this->parameterNames(CampaignRetrieveAnalyticsParams::class, 'with'), 0, 5),
        );
        self::assertSame(
            ['id', 'days', 'endDate', 'include', 'interval', 'startDate', 'requestOptions'],
            array_slice($this->parameterNames(CampaignService::class, 'retrieveAnalytics'), 0, 7),
        );
        self::assertSame(
            [
                'androidNativeShares',
                'blueskyShares',
                'copyRefLinkShares',
                'emailShares',
                'facebookShares',
                'impressions',
                'invites',
                'iosNativeShares',
                'linkedInShares',
                'messengerShares',
                'participants',
                'periodStart',
                'pinterestShares',
                'qrcodeShares',
                'redditShares',
                'referralCreditExpireds',
                'referralCreditPendings',
                'referrals',
                'smsShares',
                'telegramShares',
                'threadsShares',
                'totalCommissionCount',
                'totalCommissions',
                'totalRevenue',
                'tumblrShares',
                'twitterShares',
                'uniqueCommissionReferrals',
                'uniqueImpressions',
                'wechatShares',
                'whatsAppShares',
            ],
            array_slice($this->parameterNames(ParticipantSeries::class, 'with'), 0, 30),
        );
    }

    /**
     * @param array<string, mixed>|null $engagement
     *
     * @return array<string, mixed>
     */
    private function campaignAnalyticsFixture(?array $engagement = null): array
    {
        $fixture = ['analytics' => [], 'startDate' => 1_767_225_600_000, 'endDate' => 1_769_904_000_000];
        if (null !== $engagement) {
            $fixture['engagement'] = $engagement;
        }

        return $fixture;
    }

    /** @return array<string, mixed> */
    private function engagementFixture(): array
    {
        $unavailableMetric = ['state' => 'UNAVAILABLE', 'value' => null, 'reason' => 'PRE_COVERAGE'];

        return [
            'coverageStartAt' => null,
            'metricContractVersion' => 1,
            'programType' => 'REFERRAL',
            'timezone' => 'UTC',
            'interval' => 'day',
            'platform' => ['requested' => 'IOS', 'applied' => 'IOS', 'state' => 'AVAILABLE'],
            'period' => [
                'from' => 1_767_225_600_000,
                'to' => 1_769_904_000_000,
                'effectiveFrom' => null,
                'previousFrom' => 1_764_547_200_000,
                'previousTo' => 1_767_225_600_000,
            ],
            'state' => 'PARTIAL',
            'reason' => 'PRE_COVERAGE',
            'totals' => [
                'activeParticipants' => $unavailableMetric,
                'sharingParticipants' => $unavailableMetric,
                'sharingRate' => $unavailableMetric,
                'repeatActiveParticipants' => $unavailableMetric,
                'repeatSharingParticipants' => $unavailableMetric,
                'retainedActiveParticipants' => $unavailableMetric,
                'portalViews' => $unavailableMetric,
                'shareActions' => $unavailableMetric,
            ],
            'previousPeriod' => ['state' => 'UNAVAILABLE', 'reason' => 'PRE_COVERAGE', 'totals' => null],
            'comparison' => ['state' => 'UNAVAILABLE', 'reason' => 'PRE_COVERAGE', 'metrics' => null],
            'series' => [],
            'breakdowns' => [
                'platforms' => [],
                'portalViewSources' => [],
                'shareChannels' => [],
                'firstShareChannels' => [],
            ],
        ];
    }

    /** @return array<string, mixed> */
    private function activationFixture(): array
    {
        return [
            'coverageStartAt' => null,
            'metricContractVersion' => 1,
            'programType' => 'AFFILIATE',
            'timezone' => 'UTC',
            'cohortInterval' => 'week',
            'observationWindowDays' => 7,
            'portalViewedLabel' => 'Affiliate portal viewed',
            'portalViewedHelperText' => 'First covered affiliate portal view.',
            'aggregate' => [
                'state' => 'UNAVAILABLE',
                'reason' => 'PRE_COVERAGE',
                'cohort' => [
                    'from' => 1_767_225_600_000,
                    'to' => 1_769_904_000_000,
                    'effectiveFrom' => null,
                    'maturedAt' => 1_772_496_000_000,
                    'asOf' => 1_772_496_000_000,
                    'anchorField' => 'approvedAsAffiliateAt',
                ],
                'strictStages' => null,
                'rawStageCounts' => null,
                'stalledSegments' => null,
                'outcomes' => null,
                'largestDrop' => null,
            ],
            'cohorts' => [],
        ];
    }

    /** @return array<string, mixed> */
    private function participantAnalyticsFixture(bool $covered = false): array
    {
        $milestone = $covered ? 1_767_398_400_000 : null;

        return [
            'analytics' => [],
            'ranks' => [],
            'shareCount' => [],
            'activation' => [
                'coverageStartAt' => $covered ? 1_767_225_600_000 : null,
                'metricContractVersion' => 1,
                'programType' => 'AFFILIATE',
                'state' => $covered ? 'AVAILABLE' : 'PARTIAL',
                'reason' => $covered ? null : 'PRE_COVERAGE',
                'cohort' => ['anchorField' => 'approvedAsAffiliateAt', 'anchorAt' => $milestone],
                'enrolledAsAdvocateAt' => $milestone,
                'milestones' => [
                    'firstPortalViewedAt' => $milestone,
                    'firstReferralLinkCopiedAt' => null,
                    'firstShareAt' => $milestone,
                    'firstShareChannel' => $covered ? 'copyRefLink' : null,
                    'firstUniqueClickAt' => null,
                    'firstLeadAt' => null,
                    'firstReferralAt' => null,
                    'firstRewardAt' => null,
                    'firstCommissionAt' => null,
                    'payoutSetupCompletedAt' => null,
                ],
            ],
            'series' => [[
                'periodStart' => 1_767_225_600_000,
                'portalViews' => $covered ? 0 : null,
                'shareActions' => $covered ? 1 : null,
            ]],
        ];
    }

    /** @return array<int|string, array<mixed>|string> */
    private function query(string $query): array
    {
        parse_str($query, $parsed);

        return $parsed;
    }

    /**
     * @param class-string $class
     *
     * @return list<string>
     */
    private function parameterNames(string $class, string $method): array
    {
        return array_map(
            static fn (\ReflectionParameter $parameter): string => $parameter->getName(),
            (new \ReflectionMethod($class, $method))->getParameters(),
        );
    }

    /** @param array<string, mixed> $body */
    private function jsonResponse(array $body): ResponseInterface
    {
        return Psr17FactoryDiscovery::findResponseFactory()
            ->createResponse()
            ->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->withBody(Psr17FactoryDiscovery::findStreamFactory()->createStream(
                json_encode($body, flags: Util::JSON_ENCODE_FLAGS) ?: ''
            ))
        ;
    }
}
