<?php

declare(strict_types=1);

namespace Tests;

use Growsurf\Campaign\Participant\ParticipantRetrieveAnalyticsParams;
use Growsurf\EmailAnalytics;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class EmailAnalyticsTest extends TestCase
{
    #[Test]
    public function itModelsEmailMetricsAndParticipantIncludeTokens(): void
    {
        $analytics = EmailAnalytics::with(
            sent: 2,
            delivered: 1,
            opened: 1,
            clicked: 0,
            bounced: 1,
            spamComplaints: 0,
            deliveryRate: 0.5,
            openRate: 1.0,
            clickRate: 0.0,
            bounceRate: 0.5,
            byType: [],
            coverageStartDate: null,
            isPartial: false,
        );
        $params = ParticipantRetrieveAnalyticsParams::with(id: 'campaign', include: 'email,futureEnrichment');

        self::assertSame(2, $analytics->sent);
        self::assertSame('email,futureEnrichment', $params->include);
    }
}
