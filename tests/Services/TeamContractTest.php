<?php

declare(strict_types=1);

namespace Tests\Services;

use Growsurf\Account\CreateAccountResponse;
use Growsurf\Client as GrowsurfClient;
use Growsurf\Core\Util;
use Growsurf\Team\Team;
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
final class TeamContractTest extends TestCase
{
    #[Test]
    public function testFinalTeamRequestPaths(): void
    {
        $transporter = new Client;
        $team = [
            'name' => 'Pied Piper',
            'verificationStatus' => 'VERIFIED',
            'verificationRequestedAt' => 1719792000000,
        ];
        $transporter->addResponse($this->jsonResponse($team));
        $transporter->addResponse($this->jsonResponse($team));
        $transporter->addResponse($this->jsonResponse($team));
        $transporter->addResponse($this->jsonResponse(['success' => true, 'status' => 'SENT']));
        $transporter->addResponse($this->jsonResponse(['apiKey' => 'sk_api_replacement']));

        $client = new GrowsurfClient(
            apiKey: 'My API Key',
            baseUrl: 'http://localhost',
            requestOptions: ['transporter' => $transporter],
        );

        $this->assertSame('Pied Piper', $client->team->retrieve()->name);
        $client->team->update(name: 'Pied Piper Labs');
        $client->team->requestVerification();
        $client->team->resendOwnerVerificationEmail();
        $this->assertSame('sk_api_replacement', $client->team->rotateApiKey()->apiKey);

        $requests = $transporter->getRequests();
        $this->assertSame(
            [
                ['GET', '/team'],
                ['PATCH', '/team'],
                ['POST', '/team/verification-request'],
                ['POST', '/team/owner/verification-email'],
                ['POST', '/api-key/rotate'],
            ],
            array_map(
                static fn ($request): array => [$request->getMethod(), $request->getUri()->getPath()],
                $requests,
            ),
        );
        $this->assertJsonStringEqualsJsonString(
            '{"name":"Pied Piper Labs"}',
            (string) $requests[1]->getBody(),
        );
    }

    #[Test]
    public function testSafeTeamAndOnboardingModels(): void
    {
        $teamProperties = array_keys(get_class_vars(Team::class));
        $onboardingProperties = array_keys(get_class_vars(CreateAccountResponse::class));

        $this->assertNotContains('id', $teamProperties);
        $this->assertNotContains('email', $teamProperties);
        $this->assertNotContains('id', $onboardingProperties);
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
