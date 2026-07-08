<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * The list of a program's configured rewards.
 *
 * @phpstan-import-type RewardShape from \Growsurf\Campaign\Reward
 *
 * @phpstan-type CampaignRewardListResponseShape = array{
 *   rewards: list<Reward|RewardShape>
 * }
 */
final class CampaignRewardListResponse implements BaseModel
{
    /** @use SdkModel<CampaignRewardListResponseShape> */
    use SdkModel;

    /**
     * The program's configured rewards.
     *
     * @var list<Reward> $rewards
     */
    #[Required(list: Reward::class)]
    public array $rewards;

    /**
     * `new CampaignRewardListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CampaignRewardListResponse::with(rewards: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CampaignRewardListResponse)->withRewards(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Reward|RewardShape> $rewards
     */
    public static function with(array $rewards): self
    {
        $self = new self;

        $self['rewards'] = $rewards;

        return $self;
    }

    /**
     * The program's configured rewards.
     *
     * @param list<Reward|RewardShape> $rewards
     */
    public function withRewards(array $rewards): self
    {
        $self = clone $this;
        $self['rewards'] = $rewards;

        return $self;
    }
}
