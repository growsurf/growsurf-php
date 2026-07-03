<?php

namespace Tests\Services\Campaign;

use Growsurf\Campaign\CampaignRewardListResponse;
use Growsurf\Campaign\DeleteRewardResponse;
use Growsurf\Campaign\Reward;
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
final class RewardsTest extends TestCase
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
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->rewards->list('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CampaignRewardListResponse::class, $result);
    }

    #[Test]
    public function testCreate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->rewards->create('id', 'SINGLE_SIDED');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Reward::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->rewards->create(
            'id',
            'SINGLE_SIDED',
            commissionStructure: ['amount' => 5000, 'type' => 'AMOUNT'],
            conversionsRequired: 1,
            couponCode: 'couponCode',
            description: 'Get $10 off',
            imageURL: 'https://example.com/reward.png',
            isActive: true,
            isUnlimited: false,
            isVisible: true,
            limit: 5,
            limitDuration: 'IN_TOTAL',
            metadata: ['foo' => 'bar'],
            nextMilestonePrefix: 'You are only',
            nextMilestoneSuffix: 'referrals away!',
            numberOfWinners: 3,
            order: 0,
            referralCouponCode: 'referralCouponCode',
            referralDescription: 'Your friend gets $10 off',
            referredRewardUpfront: false,
            title: 'Reward',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Reward::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->rewards->update('campaignRewardId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Reward::class, $result);
    }

    #[Test]
    public function testUpdateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->rewards->update(
            'campaignRewardId',
            id: 'id',
            commissionStructure: ['amount' => 5000, 'type' => 'AMOUNT'],
            conversionsRequired: 1,
            couponCode: 'couponCode',
            description: 'Get $10 off',
            imageURL: 'https://example.com/reward.png',
            isActive: true,
            isUnlimited: false,
            isVisible: true,
            limit: 5,
            limitDuration: 'IN_TOTAL',
            metadata: ['foo' => 'bar'],
            nextMilestonePrefix: 'You are only',
            nextMilestoneSuffix: 'referrals away!',
            numberOfWinners: 3,
            order: 0,
            referralCouponCode: 'referralCouponCode',
            referralDescription: 'Your friend gets $10 off',
            referredRewardUpfront: false,
            title: 'Reward',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Reward::class, $result);
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->rewards->delete('campaignRewardId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DeleteRewardResponse::class, $result);
    }

    #[Test]
    public function testDeleteWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->rewards->delete('campaignRewardId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DeleteRewardResponse::class, $result);
    }
}
