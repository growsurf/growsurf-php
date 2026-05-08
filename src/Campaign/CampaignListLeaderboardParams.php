<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Campaign\CampaignListLeaderboardParams\LeaderboardType;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Retrieves participants in leaderboard order for the specified leaderboard type.
 *
 * @see Growsurf\Services\CampaignService::listLeaderboard()
 *
 * @phpstan-type CampaignListLeaderboardParamsShape = array{
 *   isMonthly?: bool|null,
 *   leaderboardType?: null|LeaderboardType|value-of<LeaderboardType>,
 *   limit?: int|null,
 *   nextID?: string|null,
 * }
 */
final class CampaignListLeaderboardParams implements BaseModel
{
    /** @use SdkModel<CampaignListLeaderboardParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Deprecated. Use `leaderboardType=CURRENT_MONTH` instead.
     */
    #[Optional]
    public ?bool $isMonthly;

    /**
     * Leaderboard ordering mode.
     *
     * @var value-of<LeaderboardType>|null $leaderboardType
     */
    #[Optional(enum: LeaderboardType::class)]
    public ?string $leaderboardType;

    /**
     * Number of results to return. Maximum 100.
     */
    #[Optional]
    public ?int $limit;

    /**
     * ID to start the next paged result set with.
     */
    #[Optional]
    public ?string $nextID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param LeaderboardType|value-of<LeaderboardType>|null $leaderboardType
     */
    public static function with(
        ?bool $isMonthly = null,
        LeaderboardType|string|null $leaderboardType = null,
        ?int $limit = null,
        ?string $nextID = null,
    ): self {
        $self = new self;

        null !== $isMonthly && $self['isMonthly'] = $isMonthly;
        null !== $leaderboardType && $self['leaderboardType'] = $leaderboardType;
        null !== $limit && $self['limit'] = $limit;
        null !== $nextID && $self['nextID'] = $nextID;

        return $self;
    }

    /**
     * Deprecated. Use `leaderboardType=CURRENT_MONTH` instead.
     */
    public function withIsMonthly(bool $isMonthly): self
    {
        $self = clone $this;
        $self['isMonthly'] = $isMonthly;

        return $self;
    }

    /**
     * Leaderboard ordering mode.
     *
     * @param LeaderboardType|value-of<LeaderboardType> $leaderboardType
     */
    public function withLeaderboardType(
        LeaderboardType|string $leaderboardType
    ): self {
        $self = clone $this;
        $self['leaderboardType'] = $leaderboardType;

        return $self;
    }

    /**
     * Number of results to return. Maximum 100.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * ID to start the next paged result set with.
     */
    public function withNextID(string $nextID): self
    {
        $self = clone $this;
        $self['nextID'] = $nextID;

        return $self;
    }
}
