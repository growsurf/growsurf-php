<?php

namespace Tests\Services;

use Growsurf\Account\Account;
use Growsurf\Account\CreateAccountResponse;
use Growsurf\Account\RotateApiKeyResponse;
use Growsurf\Account\VerificationEmailResponse;
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
final class AccountTest extends TestCase
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
    public function testCreate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->account->create('richard@piedpiper.com');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CreateAccountResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->account->create(
            'richard@piedpiper.com',
            company: 'Pied Piper',
            firstName: 'Richard',
            lastName: 'Hendricks',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CreateAccountResponse::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->account->retrieve();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Account::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->account->update();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Account::class, $result);
    }

    #[Test]
    public function testUpdateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->account->update(
            company: 'Pied Piper',
            firstName: 'Richard',
            lastName: 'Hendricks',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Account::class, $result);
    }

    #[Test]
    public function testRotateApiKey(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->account->rotateApiKey();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RotateApiKeyResponse::class, $result);
    }

    #[Test]
    public function testRequestVerification(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->account->requestVerification();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Account::class, $result);
    }

    #[Test]
    public function testResendVerificationEmail(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->account->resendVerificationEmail();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(VerificationEmailResponse::class, $result);
    }
}
