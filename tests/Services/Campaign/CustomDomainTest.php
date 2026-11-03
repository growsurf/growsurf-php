<?php

namespace Tests\Services\Campaign;

use Growsurf\Campaign\CampaignCustomDomain;
use Growsurf\Campaign\CampaignCustomDomain\DnsRecord;
use Growsurf\Campaign\DeleteCampaignCustomDomainResponse;
use Growsurf\Client;
use Growsurf\Core\Util;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Mock\Client as MockClient;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class CustomDomainTest extends TestCase
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

        $result = $this->client->campaign->customDomain->retrieve('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CampaignCustomDomain::class, $result);
    }

    #[Test]
    public function testSet(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->customDomain->set(
            'id',
            domain: 'refer.piedpiper.com'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CampaignCustomDomain::class, $result);
    }

    #[Test]
    public function testVerify(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->customDomain->verify('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CampaignCustomDomain::class, $result);
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->customDomain->delete('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DeleteCampaignCustomDomainResponse::class, $result);
    }

    #[Test]
    public function testRequestsAndNullableFields(): void
    {
        $transporter = new MockClient;
        $unset = [
            'domain' => null,
            'isVerified' => false,
            'verifiedAt' => null,
            'dnsRecord' => null,
            'createdAt' => null,
            'updatedAt' => null,
        ];
        $pending = [
            'domain' => 'https://refer.piedpiper.com',
            'isVerified' => false,
            'verifiedAt' => null,
            'dnsRecord' => [
                'type' => 'CNAME',
                'name' => 'refer.piedpiper.com',
                'value' => 'grow.surf',
            ],
            'createdAt' => 1761955200000,
            'updatedAt' => 1761955200000,
        ];
        $transporter->addResponse($this->jsonResponse($unset));
        $transporter->addResponse($this->jsonResponse($pending));
        $transporter->addResponse($this->jsonResponse(
            ['verifiedAt' => 1761955300000, 'isVerified' => true] + $pending
        ));
        $transporter->addResponse($this->jsonResponse(
            ['domain' => 'https://refer.piedpiper.com', 'success' => true]
        ));

        $client = new Client(
            apiKey: 'My API Key',
            baseUrl: 'http://localhost',
            requestOptions: ['transporter' => $transporter],
        );

        $retrieved = $client->campaign->customDomain->retrieve('campaign-id');
        $this->assertNull($retrieved->domain);
        $this->assertNull($retrieved->verifiedAt);
        $this->assertNull($retrieved->dnsRecord);
        $this->assertNull($retrieved->createdAt);
        $this->assertNull($retrieved->updatedAt);
        $this->assertSame($unset, $retrieved->jsonSerialize());

        $set = $client->campaign->customDomain->set('campaign-id', domain: 'refer.piedpiper.com');
        $this->assertInstanceOf(DnsRecord::class, $set->dnsRecord);
        $this->assertSame('CNAME', $set->dnsRecord->type);
        $this->assertSame('grow.surf', $set->dnsRecord->value);

        $verified = $client->campaign->customDomain->verify('campaign-id');
        $this->assertTrue($verified->isVerified);
        $this->assertSame(1761955300000, $verified->verifiedAt);

        $deleted = $client->campaign->customDomain->delete('campaign-id');
        $this->assertSame('https://refer.piedpiper.com', $deleted->domain);
        $this->assertTrue($deleted->success);

        $requests = $transporter->getRequests();
        $this->assertSame(
            [
                ['GET', '/campaign/campaign-id/custom-domain'],
                ['PUT', '/campaign/campaign-id/custom-domain'],
                ['POST', '/campaign/campaign-id/custom-domain/verify'],
                ['DELETE', '/campaign/campaign-id/custom-domain'],
            ],
            array_map(
                static fn ($request): array => [$request->getMethod(), $request->getUri()->getPath()],
                $requests,
            ),
        );
        $this->assertJsonStringEqualsJsonString(
            '{"domain":"refer.piedpiper.com"}',
            (string) $requests[1]->getBody(),
        );
    }

    /**
     * @param array<string, mixed> $body
     */
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
