<?php

namespace Tests\Services\Campaign;

use Growsurf\Campaign\ProgramResource;
use Growsurf\Campaign\ProgramResourceUploadTicket;
use Growsurf\Client;
use Growsurf\Core\Conversion;
use Growsurf\Core\Util;
use Growsurf\Services\Campaign\ProgramResourcesService;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class ProgramResourcesTest extends TestCase
{
    #[Test]
    public function testResourcesServiceIsAttached(): void
    {
        $testURL = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(apiKey: 'My API Key', baseUrl: $testURL);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ProgramResourcesService::class, $client->campaign->resources);
    }

    #[Test]
    public function testResourceAndUploadTicketMatchThePublicContract(): void
    {
        $resource = Conversion::coerce(ProgramResource::class, value: [
            'id' => 'resource-id',
            'type' => 'LINK',
            'title' => 'Partner guide',
            'description' => null,
            'category' => null,
            'url' => 'https://example.com/guide',
            'text' => null,
            'file' => null,
            'isPublished' => true,
            'position' => 0,
            'createdAt' => 1_788_134_400_000,
            'updatedAt' => 1_788_134_460_000,
        ]);
        $ticket = Conversion::coerce(ProgramResourceUploadTicket::class, value: [
            'ticket' => 'one-time-ticket-with-enough-entropy',
            'expiresIn' => 600,
            'uploadUrl' => 'https://uploads.example.com/v1/upload',
            'uploadParameters' => [
                'signature' => 'signed',
                'timestamp' => 1_788_134_400,
                'overwrite' => false,
            ],
        ]);

        self::assertInstanceOf(ProgramResource::class, $resource);
        self::assertInstanceOf(ProgramResourceUploadTicket::class, $ticket);
        self::assertIsInt($resource->createdAt);
        self::assertIsInt($resource->updatedAt);
        self::assertSame('signed', $ticket->uploadParameters['signature']);
        self::assertSame(1_788_134_400, $ticket->uploadParameters['timestamp']);
        self::assertFalse($ticket->uploadParameters['overwrite']);
        self::assertFalse(property_exists($ticket, 'cloudName'));
    }

    #[Test]
    public function testCreateRejectsCrossTypeFieldsBeforeRequest(): void
    {
        $client = new Client(apiKey: 'My API Key', baseUrl: 'http://127.0.0.1:4010');

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('only one Program Resource type');
        $client->campaign->resources->raw->create('program-id', [
            'type' => 'LINK',
            'title' => 'Guide',
            'url' => 'https://example.com/guide',
            'text' => 'Guide',
        ]);
    }

    #[Test]
    public function testUpdateRequiresTheUploadPairBeforeRequest(): void
    {
        $client = new Client(apiKey: 'My API Key', baseUrl: 'http://127.0.0.1:4010');

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('must be supplied together');
        $client->campaign->resources->raw->update('resource-id', 'program-id', [
            'uploadTicket' => 'one-time-ticket',
        ]);
    }

    #[Test]
    public function testUpdateAndUploadTicketEnforcePublicBoundsBeforeRequest(): void
    {
        $client = new Client(apiKey: 'My API Key', baseUrl: 'http://127.0.0.1:4010');
        $cases = [
            [
                static fn () => $client->campaign->resources->raw->update('resource-id', 'program-id', []),
                'requires at least one field',
            ],
            [
                static fn () => $client->campaign->resources->raw->update(
                    'resource-id',
                    'program-id',
                    ['position' => 100],
                ),
                'position must be an integer from 0 through 99',
            ],
            [
                static fn () => $client->campaign->resources->raw->createUploadTicket('program-id', [
                    'fileName' => str_repeat('a', 117).'.pdf',
                    'mimeType' => 'application/pdf',
                    'bytes' => 42,
                ]),
                'fileName must contain 1 through 120 characters',
            ],
        ];

        foreach ($cases as [$call, $message]) {
            try {
                $call();
                self::fail('Expected the Program Resource request to be rejected before HTTP');
            } catch (\InvalidArgumentException $exception) {
                self::assertStringContainsString($message, $exception->getMessage());
            }
        }
    }
}
