<?php

namespace Tests\Services\Campaign;

use Growsurf\Client;
use Growsurf\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 *
 * @phpstan-import-type CampaignDesignUpdateShape from \Growsurf\Campaign\CampaignDesign
 */
#[CoversNothing]
final class DesignTest extends TestCase
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

        $result = $this->client->campaign->design->retrieve('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsArray($result);
    }

    #[Test]
    public function testUpdate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->design->update('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsArray($result);
    }

    #[Test]
    public function testUpdateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        /** @var CampaignDesignUpdateShape $body */
        $body = [
            'participantAvatarStyle' => 'CHARACTERS',
            'resources' => [
                'isPublicDisplayed' => true,
                'title' => 'Resources',
                'viewResourcesLinkText' => 'View resources',
                'backLinkText' => 'Back',
                'copyButtonText' => 'Copy',
                'copiedText' => 'Copied',
                'icon' => [
                    'type' => 'IMAGE',
                    'imageUrl' => 'https://example.com/resources-icon.png',
                ],
            ],
            'theme' => ['primaryColor' => '#000000'],
            'payoutDestinationConfirmation' => [
                'headline' => 'Confirm your {{payoutProvider}} payout email',
            ],
        ];
        $result = $this->client->campaign->design->update('id', body: $body);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsArray($result);
    }
}
