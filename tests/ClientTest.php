<?php

namespace Tests;

use Growsurf\Core\Util;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Mock\Client;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class ClientTest extends TestCase
{
    public function testDefaultHeaders(): void
    {
        $transporter = new Client;
        $mockRsp = Psr17FactoryDiscovery::findResponseFactory()
            ->createResponse()
            ->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->withBody(Psr17FactoryDiscovery::findStreamFactory()->createStream(json_encode([], flags: Util::JSON_ENCODE_FLAGS) ?: ''))
        ;

        $transporter->setDefaultResponse($mockRsp);

        $client = new \Growsurf\Client(
            baseUrl: 'http://localhost',
            apiKey: 'My API Key',
            requestOptions: ['transporter' => $transporter],
        );

        $client->campaign->list();

        $this->assertNotFalse($requested = $transporter->getRequests()[0] ?? false);

        foreach (['accept', 'content-type'] as $header) {
            $sent = $requested->getHeaderLine($header);
            $this->assertNotEmpty($sent);
        }
    }

    public function testApiKeyRotationHasAnIdempotencyKey(): void
    {
        $transporter = new Client;
        $mockRsp = Psr17FactoryDiscovery::findResponseFactory()
            ->createResponse()
            ->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->withBody(Psr17FactoryDiscovery::findStreamFactory()->createStream(
                json_encode(['apiKey' => 'sk_api_0123456789abcdef0123456789abcdef_newsecret'], flags: Util::JSON_ENCODE_FLAGS) ?: ''
            ))
        ;
        $transporter->setDefaultResponse($mockRsp);
        $client = new \Growsurf\Client(
            baseUrl: 'http://localhost',
            apiKey: 'My API Key',
            requestOptions: ['transporter' => $transporter],
        );

        $client->team->rotateApiKey();

        $this->assertNotFalse($requested = $transporter->getRequests()[0] ?? false);
        $this->assertSame('/api-key/rotate', $requested->getUri()->getPath());
        $this->assertMatchesRegularExpression(
            '/^stainless-php-retry-/',
            $requested->getHeaderLine('Idempotency-Key'),
        );
    }

    public function testApiKeyRotationPreservesAnExplicitIdempotencyKey(): void
    {
        $transporter = new Client;
        $mockRsp = Psr17FactoryDiscovery::findResponseFactory()
            ->createResponse()
            ->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->withBody(Psr17FactoryDiscovery::findStreamFactory()->createStream(
                json_encode(['apiKey' => 'sk_api_0123456789abcdef0123456789abcdef_newsecret'], flags: Util::JSON_ENCODE_FLAGS) ?: ''
            ))
        ;
        $transporter->setDefaultResponse($mockRsp);
        $client = new \Growsurf\Client(
            baseUrl: 'http://localhost',
            apiKey: 'My API Key',
            requestOptions: ['transporter' => $transporter],
        );

        $client->team->rotateApiKey(requestOptions: [
            'extraHeaders' => ['Idempotency-Key' => 'caller-stable-rotation-key'],
        ]);

        $this->assertNotFalse($requested = $transporter->getRequests()[0] ?? false);
        $this->assertSame(
            'caller-stable-rotation-key',
            $requested->getHeaderLine('Idempotency-Key'),
        );
    }

    public function testAccountCreationNeverSendsAuthorization(): void
    {
        $transporter = new Client;
        $mockRsp = Psr17FactoryDiscovery::findResponseFactory()
            ->createResponse()
            ->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->withBody(Psr17FactoryDiscovery::findStreamFactory()->createStream(json_encode([
                'email' => 'richard@piedpiper.com',
                'apiKey' => 'new_key',
                'verificationStatus' => 'NOT_REQUESTED',
            ], flags: Util::JSON_ENCODE_FLAGS) ?: ''))
        ;
        $transporter->setDefaultResponse($mockRsp);
        $client = new \Growsurf\Client(
            baseUrl: 'http://localhost',
            apiKey: 'My API Key',
            requestOptions: ['transporter' => $transporter],
        );

        $client->account->create('richard@piedpiper.com');

        $this->assertNotFalse($requested = $transporter->getRequests()[0] ?? false);
        $this->assertSame('/accounts', $requested->getUri()->getPath());
        $this->assertFalse($requested->hasHeader('Authorization'));
    }

    public function testAccountCreationSupportsAKeylessClient(): void
    {
        $transporter = new Client;
        $mockRsp = Psr17FactoryDiscovery::findResponseFactory()
            ->createResponse()
            ->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->withBody(Psr17FactoryDiscovery::findStreamFactory()->createStream(json_encode([
                'email' => 'richard@piedpiper.com',
                'apiKey' => 'new_key',
                'verificationStatus' => 'NOT_REQUESTED',
            ], flags: Util::JSON_ENCODE_FLAGS) ?: ''))
        ;
        $transporter->setDefaultResponse($mockRsp);
        $client = new \Growsurf\Client(
            baseUrl: 'http://localhost',
            requestOptions: ['transporter' => $transporter],
        );

        $client->account->create('richard@piedpiper.com');

        $this->assertNotFalse($requested = $transporter->getRequests()[0] ?? false);
        $this->assertFalse($requested->hasHeader('Authorization'));
    }
}
