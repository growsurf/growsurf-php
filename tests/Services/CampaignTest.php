<?php

namespace Tests\Services;

use Growsurf\Campaign\Campaign;
use Growsurf\Campaign\CampaignGetAnalyticsResponse;
use Growsurf\Campaign\CampaignListResponse;
use Growsurf\Campaign\CampaignNewMobileParticipantTokenResponse;
use Growsurf\Campaign\ReferralFlowScreenshotsResponse;
use Growsurf\Campaign\ParticipantCommissionList;
use Growsurf\Campaign\ParticipantList;
use Growsurf\Campaign\ParticipantPayoutList;
use Growsurf\Campaign\ReferralList;
use Growsurf\Client;
use Growsurf\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class CampaignTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->retrieve('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Campaign::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CampaignListResponse::class, $result);
    }

    #[Test]
    public function testCreate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->create('REFERRAL');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Campaign::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->create(
            'REFERRAL',
            companyLogoImageURL: 'companyLogoImageUrl',
            companyName: 'companyName',
            currencyISO: 'USD',
            name: 'name',
            rewards: [['type' => 'SINGLE_SIDED']],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Campaign::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->update('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Campaign::class, $result);
    }

    #[Test]
    public function testUpdateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->update(
            'id',
            companyLogoImageURL: 'companyLogoImageUrl',
            companyName: 'companyName',
            name: 'name',
            status: 'IN_PROGRESS',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Campaign::class, $result);
    }

    #[Test]
    public function testClone(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->clone('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Campaign::class, $result);
    }

    #[Test]
    public function testGetReferralFlowScreenshots(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->getReferralFlowScreenshots('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ReferralFlowScreenshotsResponse::class, $result);
    }

    #[Test]
    public function testCreateMobileParticipantToken(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->createMobileParticipantToken(
            'id',
            email: 'dev@stainless.com'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            CampaignNewMobileParticipantTokenResponse::class,
            $result
        );
    }

    #[Test]
    public function testCreateMobileParticipantTokenWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->createMobileParticipantToken(
            'id',
            email: 'dev@stainless.com',
            fingerprint: 'fingerprint',
            firstName: 'firstName',
            ipAddress: 'ipAddress',
            lastName: 'lastName',
            metadata: ['foo' => 'bar'],
            mobileInstanceID: 'mobileInstanceId',
            referralStatus: 'CREDIT_PENDING',
            referredBy: 'referredBy',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            CampaignNewMobileParticipantTokenResponse::class,
            $result
        );
    }

    #[Test]
    public function testListCommissions(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->listCommissions('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ParticipantCommissionList::class, $result);
    }

    #[Test]
    public function testListLeaderboard(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->listLeaderboard('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ParticipantList::class, $result);
    }

    #[Test]
    public function testListParticipants(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->listParticipants('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ParticipantList::class, $result);
    }

    #[Test]
    public function testListPayouts(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->listPayouts('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ParticipantPayoutList::class, $result);
    }

    #[Test]
    public function testListReferrals(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->listReferrals('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ReferralList::class, $result);
    }

    #[Test]
    public function testRetrieveAnalytics(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->retrieveAnalytics('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CampaignGetAnalyticsResponse::class, $result);
    }

    #[Test]
    public function testRetrieveAnalyticsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->retrieveAnalytics(
            'id',
            days: 365,
            include: 'previousPeriod,statusCounts,rates',
            interval: 'month',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CampaignGetAnalyticsResponse::class, $result);
    }
}
