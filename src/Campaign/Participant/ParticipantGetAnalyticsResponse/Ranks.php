<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\ParticipantGetAnalyticsResponse;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type RanksShape = array{
 *   monthlyRank?: int|null, prevMonthlyRank?: int|null, rank?: int|null
 * }
 */
final class Ranks implements BaseModel
{
    /** @use SdkModel<RanksShape> */
    use SdkModel;

    #[Optional(nullable: true)]
    public ?int $monthlyRank;

    #[Optional(nullable: true)]
    public ?int $prevMonthlyRank;

    /**
     * All-time rank (1-indexed), or null when unranked.
     */
    #[Optional(nullable: true)]
    public ?int $rank;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?int $monthlyRank = null,
        ?int $prevMonthlyRank = null,
        ?int $rank = null,
    ): self {
        $self = new self;

        null !== $monthlyRank && $self['monthlyRank'] = $monthlyRank;
        null !== $prevMonthlyRank && $self['prevMonthlyRank'] = $prevMonthlyRank;
        null !== $rank && $self['rank'] = $rank;

        return $self;
    }

    public function withMonthlyRank(?int $monthlyRank): self
    {
        $self = clone $this;
        $self['monthlyRank'] = $monthlyRank;

        return $self;
    }

    public function withPrevMonthlyRank(?int $prevMonthlyRank): self
    {
        $self = clone $this;
        $self['prevMonthlyRank'] = $prevMonthlyRank;

        return $self;
    }

    /**
     * All-time rank (1-indexed), or null when unranked.
     */
    public function withRank(?int $rank): self
    {
        $self = clone $this;
        $self['rank'] = $rank;

        return $self;
    }
}
