<?php

declare(strict_types=1);

namespace Tests;

use Growsurf\Campaign\CampaignGetAnalyticsResponse\StatusCounts\RewardStatus;
use Growsurf\Campaign\Participant\ParticipantGetAnalyticsResponse\Analytics;
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
}
