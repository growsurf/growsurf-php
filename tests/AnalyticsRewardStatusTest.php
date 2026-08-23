<?php

declare(strict_types=1);

namespace Tests;

use Growsurf\Campaign\CampaignGetAnalyticsResponse\Analytics as CampaignAnalytics;
use Growsurf\Campaign\CampaignGetAnalyticsResponse\Series as CampaignSeries;
use Growsurf\Campaign\CampaignGetAnalyticsResponse\StatusCounts\RewardStatus;
use Growsurf\Campaign\Participant\ParticipantGetAnalyticsResponse\Analytics;
use Growsurf\Campaign\Participant\ParticipantGetAnalyticsResponse\Series as ParticipantSeries;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversNothing]
final class AnalyticsRewardStatusTest extends TestCase
{
    #[Test]
    public function itUsesTheSameThreeRewardBucketsForCampaignAndParticipantAnalytics(): void
    {
        $rewardStatus = RewardStatus::with(unapproved: 1, unfulfilled: 2, completed: 3);
        $analytics = Analytics::with(rewardStatus: $rewardStatus);

        self::assertEquals(
            ['unapproved' => 1, 'unfulfilled' => 2, 'completed' => 3],
            $rewardStatus->jsonSerialize(),
        );
        self::assertSame($rewardStatus, $analytics->rewardStatus);
        self::assertArrayNotHasKey('pendingRewards', $analytics->jsonSerialize());
        self::assertArrayNotHasKey('rewardsEarned', $analytics->jsonSerialize());
    }

    #[Test]
    public function itSerializesUniqueCommissionReferralsAcrossAnalyticsShapes(): void
    {
        $campaignAnalytics = CampaignAnalytics::with(uniqueCommissionReferrals: 4);
        $campaignSeries = CampaignSeries::with(uniqueCommissionReferrals: 3);
        $participantSeries = ParticipantSeries::with(uniqueCommissionReferrals: 2);

        self::assertSame(['uniqueCommissionReferrals' => 4], $campaignAnalytics->jsonSerialize());
        self::assertSame(['uniqueCommissionReferrals' => 3], $campaignSeries->jsonSerialize());
        self::assertSame(['uniqueCommissionReferrals' => 2], $participantSeries->jsonSerialize());
    }
}
