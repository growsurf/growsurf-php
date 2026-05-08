<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ParticipantRewardShape from \Growsurf\Campaign\Participant\ParticipantReward
 *
 * @phpstan-type ParticipantListRewardsResponseShape = array{
 *   limit: int,
 *   nextID: string|null,
 *   rewards: list<ParticipantReward|ParticipantRewardShape>,
 * }
 */
final class ParticipantListRewardsResponse implements BaseModel
{
    /** @use SdkModel<ParticipantListRewardsResponseShape> */
    use SdkModel;

    #[Required]
    public int $limit;

    #[Required('nextId')]
    public ?string $nextID;

    /** @var list<ParticipantReward> $rewards */
    #[Required(list: ParticipantReward::class)]
    public array $rewards;

    /**
     * `new ParticipantListRewardsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantListRewardsResponse::with(limit: ..., nextID: ..., rewards: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantListRewardsResponse)
     *   ->withLimit(...)
     *   ->withNextID(...)
     *   ->withRewards(...)
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
     * @param list<ParticipantReward|ParticipantRewardShape> $rewards
     */
    public static function with(
        int $limit,
        ?string $nextID,
        array $rewards
    ): self {
        $self = new self;

        $self['limit'] = $limit;
        $self['nextID'] = $nextID;
        $self['rewards'] = $rewards;

        return $self;
    }

    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    public function withNextID(?string $nextID): self
    {
        $self = clone $this;
        $self['nextID'] = $nextID;

        return $self;
    }

    /**
     * @param list<ParticipantReward|ParticipantRewardShape> $rewards
     */
    public function withRewards(array $rewards): self
    {
        $self = clone $this;
        $self['rewards'] = $rewards;

        return $self;
    }
}
