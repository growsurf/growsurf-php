<?php

declare(strict_types=1);

namespace Tests\Models;

use Growsurf\Campaign\CampaignCreateMobileParticipantTokenParams;
use Growsurf\Campaign\Participant\Participant;
use Growsurf\Core\Conversion;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class ParticipantContractTest extends TestCase
{
    public function testAffiliateParticipantCanOmitShareURL(): void
    {
        $participant = Conversion::coerce(
            Participant::class,
            value: [
                'id' => 'participant-id',
                'email' => 'affiliate@example.com',
                'monthlyRank' => 0,
                'monthlyReferralCount' => 0,
                'rank' => 0,
                'referralCount' => 0,
                'rewards' => [],
            ],
        );

        self::assertInstanceOf(Participant::class, $participant);
        self::assertArrayNotHasKey('shareUrl', $participant->jsonSerialize());
    }

    public function testMobileParticipantTokenAcceptsIsAffiliate(): void
    {
        $params = CampaignCreateMobileParticipantTokenParams::with(
            email: 'affiliate@example.com',
            isAffiliate: true,
        );

        self::assertTrue($params->isAffiliate);
        self::assertTrue($params->jsonSerialize()['isAffiliate']);
    }
}
