<?php

namespace Tests\Services\Campaign;

use Growsurf\Campaign\DeleteWebhookResponse;
use Growsurf\Campaign\Webhook;
use Growsurf\Campaign\WebhookListResponse;
use Growsurf\Campaign\WebhookTestResponse;
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
final class WebhooksTest extends TestCase
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

        $result = $this->client->campaign->webhooks->list('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebhookListResponse::class, $result);
    }

    #[Test]
    public function testCreate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->webhooks->create(
            'id',
            'https://piedpiper.com/growsurf/webhook'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Webhook::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->webhooks->create(
            'id',
            'https://piedpiper.com/growsurf/webhook',
            events: ['NEW_PARTICIPANT_ADDED', 'PARTICIPANT_REACHED_A_GOAL'],
            isEnabled: true,
            secret: 'whsec_middleout',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Webhook::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->webhooks->update('webhookId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Webhook::class, $result);
    }

    #[Test]
    public function testUpdateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->webhooks->update(
            'webhookId',
            id: 'id',
            events: ['NEW_PARTICIPANT_ADDED'],
            isEnabled: false,
            payloadURL: 'https://piedpiper.com/growsurf/webhook',
            secret: 'whsec_middleout',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Webhook::class, $result);
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->webhooks->delete('webhookId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DeleteWebhookResponse::class, $result);
    }

    #[Test]
    public function testTest(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->webhooks->test('webhookId', id: 'id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebhookTestResponse::class, $result);
    }

    #[Test]
    public function testTestWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->webhooks->test(
            'webhookId',
            id: 'id',
            event: 'NEW_PARTICIPANT_ADDED',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebhookTestResponse::class, $result);
    }
}
