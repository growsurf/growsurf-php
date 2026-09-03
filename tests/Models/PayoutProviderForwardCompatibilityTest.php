<?php

declare(strict_types=1);

namespace Tests\Models;

use Growsurf\Campaign\Participant\ParticipantGetPayoutDestinationResponse;
use Growsurf\Campaign\Participant\ParticipantGetPayoutDestinationResponse\Destination;
use Growsurf\Campaign\Participant\ParticipantRequestPayoutDestinationConfirmationResponse;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class PayoutProviderForwardCompatibilityTest extends TestCase
{
    public function testUnknownFutureProviderIsPreserved(): void
    {
        $response = ParticipantGetPayoutDestinationResponse::with(
            activeProvider: 'TESTBANK',
            enabledProviders: ['TESTBANK'],
            destinations: [Destination::with(
                claimEmail: 'richard@piedpiper.com',
                confirmedAt: 1752000000000,
                legalEntityType: 'INDIVIDUAL',
                needsRepairReason: null,
                provider: 'TESTBANK',
                providerDisplayName: 'Test Bank',
                status: 'ACTIVE',
            )],
        );

        self::assertSame('TESTBANK', $response->activeProvider);
        self::assertSame(['TESTBANK'], $response->enabledProviders);
        self::assertCount(1, $response->destinations);
        self::assertSame('TESTBANK', $response->destinations[0]->provider);

        $confirmation = ParticipantRequestPayoutDestinationConfirmationResponse::with(
            expiresAt: 1752604800000,
            provider: 'TESTBANK',
            providerDisplayName: 'Test Bank',
            status: 'CONFIRMATION_REQUESTED',
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
