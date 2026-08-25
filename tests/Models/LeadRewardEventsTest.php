<?php

declare(strict_types=1);

namespace Tests\Models;

use Growsurf\Campaign\Campaign\Reward as EmbeddedReward;
use Growsurf\Campaign\CommissionEvent;
use Growsurf\Campaign\CommissionStructure;
use Growsurf\Campaign\CommissionStructure\Event as CommissionStructureEvent;
use Growsurf\Campaign\Participant\ParticipantReward;
use Growsurf\Campaign\Participant\ParticipantReward\Status as ParticipantRewardStatus;
use Growsurf\Campaign\ParticipantCommissionList\Commission;
use Growsurf\Campaign\Reward;
use Growsurf\Campaign\RewardCreateParams;
use Growsurf\Campaign\RewardEvent;
use Growsurf\Campaign\RewardUpdateParams;
use Growsurf\Core\Conversion;
use Growsurf\ServiceContracts\Campaign\RewardsContract;
use Growsurf\Services\Campaign\RewardsService;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class LeadRewardEventsTest extends TestCase
{
    public function testCampaignRewardModelsSerializeEvent(): void
    {
        $reward = Reward::with(
            id: 'reward_1',
            isUnlimited: true,
            metadata: [],
            type: 'SINGLE_SIDED',
            event: RewardEvent::LEAD,
        );
        $embeddedReward = EmbeddedReward::with(
            id: 'reward_1',
            isUnlimited: true,
            metadata: [],
            type: 'SINGLE_SIDED',
            event: RewardEvent::CONVERSION,
        );

        self::assertSame('LEAD', $reward->jsonSerialize()['event']);
        self::assertSame('CONVERSION', $embeddedReward->jsonSerialize()['event']);
    }

    public function testParamsAndCommissionSerializeEvent(): void
    {
        $create = RewardCreateParams::with(type: 'MILESTONE', event: RewardEvent::LEAD);
        $update = RewardUpdateParams::with(
            id: 'campaign_1',
            event: RewardEvent::CONVERSION,
        );
        $commission = Commission::with(
            id: 'commission_1',
            amount: 500,
            createdAt: 1,
            currencyISO: 'USD',
            event: CommissionEvent::LEAD,
            referredID: 'referred_1',
            referrerID: 'referrer_1',
            saleAmount: null,
            status: 'PENDING',
        );

        self::assertSame('LEAD', $create->jsonSerialize()['event']);
        self::assertSame('CONVERSION', $update->jsonSerialize()['event']);
        self::assertSame('LEAD', $commission->jsonSerialize()['event']);
    }

    public function testCancelledParticipantRewardHydrates(): void
    {
        self::assertSame('CANCELLED', ParticipantRewardStatus::CANCELLED->value);

        $reward = Conversion::coerce(
            ParticipantReward::class,
            value: [
                'id' => 'participant-reward-1',
                'rewardId' => 'campaign-reward-1',
                'status' => 'CANCELLED',
            ],
        );

        self::assertInstanceOf(ParticipantReward::class, $reward);
        self::assertSame('CANCELLED', $reward->jsonSerialize()['status']);
    }

    public function testCommissionStructureUsesPublishedEventEnum(): void
    {
        $commissionStructure = Conversion::coerce(
            CommissionStructure::class,
            value: ['event' => 'CLICK'],
        );
        $leadCommissionStructure = CommissionStructure::with(
            event: CommissionStructureEvent::LEAD,
        );

        self::assertInstanceOf(CommissionStructure::class, $commissionStructure);
        self::assertSame('CLICK', $commissionStructure->jsonSerialize()['event']);
        self::assertSame('LEAD', $leadCommissionStructure->jsonSerialize()['event']);
        self::assertNull($commissionStructure->withEvent(null)->event);
    }

    public function testModelFactoriesKeepExistingPositionalArgumentOrder(): void
    {
        $reward = Reward::with(
            'reward-1',
            true,
            [],
            'SINGLE_SIDED',
            null,
            null,
            null,
            'Reward description',
            'https://example.com/reward.png',
        );
        $embeddedReward = EmbeddedReward::with(
            'reward-1',
            true,
            [],
            'SINGLE_SIDED',
            null,
            null,
            null,
            'Reward description',
            'https://example.com/reward.png',
        );
        $create = RewardCreateParams::with(
            'SINGLE_SIDED',
            null,
            null,
            null,
            'Reward description',
            'https://example.com/reward.png',
        );
        $update = RewardUpdateParams::with(
            'campaign-1',
            null,
            null,
            null,
            'Reward description',
            'https://example.com/reward.png',
        );
        $commission = Commission::with(
            'commission-1',
            500,
            1,
            'USD',
            'referred-1',
            'referrer-1',
            null,
            'PENDING',
        );

        self::assertSame('https://example.com/reward.png', $reward->imageURL);
        self::assertSame('https://example.com/reward.png', $embeddedReward->imageURL);
        self::assertSame('https://example.com/reward.png', $create->imageURL);
        self::assertSame('https://example.com/reward.png', $update->imageURL);
        self::assertSame('referred-1', $commission->referredID);
        self::assertSame('referrer-1', $commission->referrerID);
        self::assertSame('SALE', $commission->event);
    }

    public function testRewardServiceKeepsPublishedConvenienceSignatures(): void
    {
        $expectedCreateParameters = [
            'id',
            'type',
            'commissionStructure',
            'conversionsRequired',
            'couponCode',
            'description',
            'imageURL',
            'isUnlimited',
            'isVisible',
            'limit',
            'limitDuration',
            'metadata',
            'nextMilestonePrefix',
            'nextMilestoneSuffix',
            'numberOfWinners',
            'order',
            'referralCouponCode',
            'referralDescription',
            'referredRewardUpfront',
            'referredValue',
            'title',
            'value',
            'requestOptions',
        ];
        $expectedUpdateParameters = [
            'campaignRewardID',
            'id',
            ...array_slice($expectedCreateParameters, 2),
        ];

        self::assertSame(
            $expectedCreateParameters,
            self::parameterNames(RewardsContract::class, 'create'),
        );
        self::assertSame(
            $expectedCreateParameters,
            self::parameterNames(RewardsService::class, 'create'),
        );
        self::assertSame(
            $expectedUpdateParameters,
            self::parameterNames(RewardsContract::class, 'update'),
        );
        self::assertSame(
            $expectedUpdateParameters,
            self::parameterNames(RewardsService::class, 'update'),
        );
        self::assertNotContains(
            'createWithParams',
            get_class_methods(RewardsContract::class),
        );
        self::assertSame(
            ['id', 'params', 'requestOptions'],
            self::parameterNames(RewardsService::class, 'createWithParams'),
        );
    }

    /**
     * @param class-string $class
     *
     * @return list<string>
     */
    private static function parameterNames(string $class, string $method): array
    {
        return array_map(
            static fn (\ReflectionParameter $parameter): string => $parameter->getName(),
            (new \ReflectionMethod($class, $method))->getParameters(),
        );
    }
}
