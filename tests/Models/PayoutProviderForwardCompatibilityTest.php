<?php

declare(strict_types=1);

namespace Tests\Models;

use Growsurf\Campaign\Participant\ParticipantGetPayoutDestinationResponse;
use Growsurf\Campaign\Participant\ParticipantGetPayoutDestinationResponse\Destination;
use Growsurf\Campaign\Participant\ParticipantRequestPayoutDestinationConfirmationResponse;
use PHPUnit\Framework\TestCase;

final class PayoutProviderForwardCompatibilityTest extends TestCase
{
    public function testUnknownFutureProviderIsPreserved(): void
    {
        $response = ParticipantGetPayoutDestinationResponse::with(
            activeProvider: 'TESTBANK',
            enabledProviders: ['TESTBANK'],
            destinations: [Destination::with(provider: 'TESTBANK')],
        );

        self::assertSame('TESTBANK', $response->activeProvider);
        self::assertSame(['TESTBANK'], $response->enabledProviders);
        self::assertNotNull($response->destinations);
        self::assertCount(1, $response->destinations);
        self::assertSame('TESTBANK', $response->destinations[0]->provider);

        $confirmation = ParticipantRequestPayoutDestinationConfirmationResponse::with(
            provider: 'TESTBANK'
        );
        self::assertSame('TESTBANK', $confirmation->provider);
    }

    public function testResponseModelsDoNotExposeStaleFieldsOrProviderEnums(): void
    {
        self::assertFalse(
            property_exists(ParticipantGetPayoutDestinationResponse::class, 'participantId')
        );
        self::assertFalse(enum_exists(
            'Growsurf\Campaign\Participant\ParticipantGetPayoutDestinationResponse\ActiveProvider'
        ));
        self::assertFalse(enum_exists(
            'Growsurf\Campaign\Participant\ParticipantGetPayoutDestinationResponse\EnabledProvider'
        ));
        self::assertFalse(enum_exists(
            'Growsurf\Campaign\Participant\ParticipantGetPayoutDestinationResponse\Destination\Provider'
        ));
        self::assertFalse(enum_exists(
            'Growsurf\Campaign\Participant\ParticipantRequestPayoutDestinationConfirmationResponse\Provider'
        ));
    }
}
