<?php

namespace Tests;

use Growsurf\Core\Exceptions\APIStatusException;
use Growsurf\Core\Exceptions\BadRequestException;
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

    public function testApiKeyRotationRetriesWithTheDefaultBaseUrl(): void
    {
        $originalBaseUrl = getenv('GROWSURF_BASE_URL');
        putenv('GROWSURF_BASE_URL');

        try {
            $transporter = new Client;
            $responseFactory = Psr17FactoryDiscovery::findResponseFactory();
            $streamFactory = Psr17FactoryDiscovery::findStreamFactory();
            $transporter->addResponse(
                $responseFactory
                    ->createResponse(500)
                    ->withHeader('Content-Type', 'application/json')
                    ->withBody($streamFactory->createStream('{}'))
            );
            $transporter->addResponse(
                $responseFactory
                    ->createResponse(200)
                    ->withHeader('Content-Type', 'application/json')
                    ->withBody($streamFactory->createStream(
                        json_encode(['apiKey' => 'sk_api_0123456789abcdef0123456789abcdef_newsecret'], flags: Util::JSON_ENCODE_FLAGS) ?: ''
                    ))
            );
            $client = new \Growsurf\Client(
                apiKey: 'My API Key',
                requestOptions: [
                    'transporter' => $transporter,
                    'initialRetryDelay' => 0,
                    'maxRetryDelay' => 0,
                ],
            );

            $client->team->rotateApiKey();

            $requests = $transporter->getRequests();
            $this->assertCount(2, $requests);
            $this->assertSame('/v2/api-key/rotate', $requests[0]->getUri()->getPath());
            $this->assertSame('/v2/api-key/rotate', $requests[1]->getUri()->getPath());
            $this->assertSame(
                $requests[0]->getHeaderLine('Idempotency-Key'),
                $requests[1]->getHeaderLine('Idempotency-Key'),
            );
        } finally {
            false === $originalBaseUrl
                ? putenv('GROWSURF_BASE_URL')
                : putenv("GROWSURF_BASE_URL={$originalBaseUrl}");
        }
    }

    public function testNonIdempotentMutationIsNotRetried(): void
    {
        $transporter = new Client;
        $transporter->setDefaultResponse(
            Psr17FactoryDiscovery::findResponseFactory()
                ->createResponse(500)
                ->withHeader('Content-Type', 'application/json')
                ->withBody(Psr17FactoryDiscovery::findStreamFactory()->createStream('{}'))
        );
        $client = new \Growsurf\Client(
            baseUrl: 'http://localhost',
            apiKey: 'My API Key',
            requestOptions: ['transporter' => $transporter],
        );

        try {
            $client->request('POST', '/campaign/p36rol/participant/p_1/email');
            $this->fail('Expected the failed mutation to raise an API status exception.');
        } catch (APIStatusException) {
        }

        $this->assertCount(1, $transporter->getRequests());
        $this->assertFalse($transporter->getRequests()[0]->hasHeader('Idempotency-Key'));
    }

    public function testStatusExceptionRetainsStructuredErrorBody(): void
    {
        $transporter = new Client;
        $error = [
            'name' => 'BadRequestError',
            'code' => 'PARTICIPANT_BLOCKED_ERROR',
            'message' => 'Participant blocked.',
            'errors' => [['field' => 'email', 'message' => 'Blocked.']],
            'status' => 400,
            'supportUrl' => 'https://app.growsurf.com/settings#contact_support',
            'policyName' => 'minute',
            'level' => 'error',
            'timestamp' => '2026-09-04T00:00:00.000Z',
            'fraudRiskLevel' => 'HIGH',
            'fraudReasonCode' => 'DUPLICATE_IDENTITY',
            'matchedParticipantIds' => ['participant-1'],
            'email' => 'blocked@example.com',
            'referrerId' => null,
            'ipAddress' => '203.0.113.10',
            'fingerprint' => 'fingerprint-1',
            'blockedAt' => '2026-09-04T00:00:00.000Z',
        ];
        $response = Psr17FactoryDiscovery::findResponseFactory()
            ->createResponse(400)
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('X-Request-ID', 'request-1')
            ->withBody(Psr17FactoryDiscovery::findStreamFactory()->createStream(
                json_encode($error, flags: Util::JSON_ENCODE_FLAGS) ?: ''
            ))
        ;
        $transporter->setDefaultResponse($response);
        $client = new \Growsurf\Client(
            baseUrl: 'http://localhost',
            apiKey: 'My API Key',
            requestOptions: ['transporter' => $transporter],
        );

        try {
            $client->campaign->list();
            $this->fail('Expected the failed request to raise a bad request exception.');
        } catch (BadRequestException $exception) {
            self::assertSame($error, $exception->body);
            self::assertSame(400, $exception->status);
            self::assertSame('BadRequestError', $exception->errorName);
            self::assertSame('PARTICIPANT_BLOCKED_ERROR', $exception->errorCode);
            self::assertSame('Participant blocked.', $exception->errorMessage);
            self::assertSame([['field' => 'email', 'message' => 'Blocked.']], $exception->errors);
            self::assertSame('https://app.growsurf.com/settings#contact_support', $exception->supportURL);
            self::assertSame('minute', $exception->policyName);
            self::assertSame('error', $exception->level);
            self::assertSame('2026-09-04T00:00:00.000Z', $exception->timestamp);
            self::assertSame('HIGH', $exception->fraudRiskLevel);
            self::assertSame('DUPLICATE_IDENTITY', $exception->fraudReasonCode);
            self::assertSame(['participant-1'], $exception->matchedParticipantIDs);
            self::assertSame('blocked@example.com', $exception->email);
            self::assertNull($exception->referrerID);
            self::assertSame('203.0.113.10', $exception->ipAddress);
            self::assertSame('fingerprint-1', $exception->fingerprint);
            self::assertSame('2026-09-04T00:00:00.000Z', $exception->blockedAt);
            self::assertSame('request-1', $exception->response?->getHeaderLine('X-Request-ID'));
            self::assertStringContainsString('Participant blocked.', $exception->getMessage());
        }
    }

    public function testPackageVersionHeaderUsesTheSdkVersion(): void
    {
        $transporter = new Client;
        $transporter->setDefaultResponse(Psr17FactoryDiscovery::findResponseFactory()->createResponse(200));
        $client = new \Growsurf\Client(
            baseUrl: 'http://localhost',
            apiKey: 'My API Key',
            requestOptions: ['transporter' => $transporter],
        );

        $client->request('GET', '/status');

        $this->assertSame(\Growsurf\VERSION, $transporter->getRequests()[0]->getHeaderLine('X-Stainless-Package-Version'));
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
