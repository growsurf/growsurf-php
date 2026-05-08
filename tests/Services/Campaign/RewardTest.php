<?php

namespace Tests\Services\Campaign;

use Growsurf\Campaign\Reward\RewardApproveResponse;
use Growsurf\Campaign\Reward\RewardDeleteResponse;
use Growsurf\Campaign\Reward\RewardFulfillResponse;
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
final class RewardTest extends TestCase
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
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->reward->delete('rewardId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RewardDeleteResponse::class, $result);
    }

    #[Test]
    public function testDeleteWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->reward->delete('rewardId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RewardDeleteResponse::class, $result);
    }

    #[Test]
    public function testApprove(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->reward->approve('rewardId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RewardApproveResponse::class, $result);
    }

    #[Test]
    public function testApproveWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->reward->approve(
            'rewardId',
            id: 'id',
            fulfill: true
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RewardApproveResponse::class, $result);
    }

    #[Test]
    public function testFulfill(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->reward->fulfill('rewardId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RewardFulfillResponse::class, $result);
    }

    #[Test]
    public function testFulfillWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->reward->fulfill('rewardId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RewardFulfillResponse::class, $result);
    }
}
