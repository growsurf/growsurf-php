<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Campaign\Campaign\Reward;
use Growsurf\Campaign\Campaign\Status;
use Growsurf\Campaign\Campaign\Type;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type RewardShape from \Growsurf\Campaign\Campaign\Reward
 *
 * @phpstan-type CampaignShape = array{
 *   id: string,
 *   impressionCount: int,
 *   inviteCount: int,
 *   name: string,
 *   participantCount: int,
 *   referralCount: int,
 *   rewards: list<Reward|RewardShape>,
 *   status: Status|value-of<Status>,
 *   type: Type|value-of<Type>,
 *   winnerCount: int,
 *   currencyISO?: string|null,
 * }
 */
final class Campaign implements BaseModel
{
    /** @use SdkModel<CampaignShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required]
    public int $impressionCount;

    #[Required]
    public int $inviteCount;

    #[Required]
    public string $name;

    #[Required]
    public int $participantCount;

    #[Required]
    public int $referralCount;

    /** @var list<Reward> $rewards */
    #[Required(list: Reward::class)]
    public array $rewards;

    /** @var value-of<Status> $status */
    #[Required(enum: Status::class)]
    public string $status;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    #[Required]
    public int $winnerCount;

    #[Optional]
    public ?string $currencyISO;

    /**
     * `new Campaign()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Campaign::with(
     *   id: ...,
     *   impressionCount: ...,
     *   inviteCount: ...,
     *   name: ...,
     *   participantCount: ...,
     *   referralCount: ...,
     *   rewards: ...,
     *   status: ...,
     *   type: ...,
     *   winnerCount: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Campaign)
     *   ->withID(...)
     *   ->withImpressionCount(...)
     *   ->withInviteCount(...)
     *   ->withName(...)
     *   ->withParticipantCount(...)
     *   ->withReferralCount(...)
     *   ->withRewards(...)
     *   ->withStatus(...)
     *   ->withType(...)
     *   ->withWinnerCount(...)
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
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        int $impressionCount,
        int $inviteCount,
        string $name,
        int $participantCount,
        int $referralCount,
        array $rewards,
        Status|string $status,
        Type|string $type,
        int $winnerCount,
        ?string $currencyISO = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['impressionCount'] = $impressionCount;
        $self['inviteCount'] = $inviteCount;
        $self['name'] = $name;
        $self['participantCount'] = $participantCount;
        $self['referralCount'] = $referralCount;
        $self['rewards'] = $rewards;
        $self['status'] = $status;
        $self['type'] = $type;
        $self['winnerCount'] = $winnerCount;

        null !== $currencyISO && $self['currencyISO'] = $currencyISO;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withImpressionCount(int $impressionCount): self
    {
        $self = clone $this;
        $self['impressionCount'] = $impressionCount;

        return $self;
    }

    public function withInviteCount(int $inviteCount): self
    {
        $self = clone $this;
        $self['inviteCount'] = $inviteCount;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withParticipantCount(int $participantCount): self
    {
        $self = clone $this;
        $self['participantCount'] = $participantCount;

        return $self;
    }

    public function withReferralCount(int $referralCount): self
    {
        $self = clone $this;
        $self['referralCount'] = $referralCount;

        return $self;
    }

    /**
     * @param list<Reward|RewardShape> $rewards
     */
    public function withRewards(array $rewards): self
    {
        $self = clone $this;
        $self['rewards'] = $rewards;

        return $self;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    public function withWinnerCount(int $winnerCount): self
    {
        $self = clone $this;
        $self['winnerCount'] = $winnerCount;

        return $self;
    }

    public function withCurrencyISO(string $currencyISO): self
    {
        $self = clone $this;
        $self['currencyISO'] = $currencyISO;

        return $self;
    }
}
