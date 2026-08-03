<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignGetAnalyticsResponse\StatusCounts;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Reward counts grouped by review and fulfillment status.
 *
 * @phpstan-type RewardStatusShape = array{
 *   completed?: int|null, unapproved?: int|null, unfulfilled?: int|null
 * }
 */
final class RewardStatus implements BaseModel
{
    /** @use SdkModel<RewardStatusShape> */
    use SdkModel;

    /**
     * Approved rewards that are fulfilled.
     */
    #[Optional]
    public ?int $completed;

    /**
     * Unapproved rewards awaiting review.
     */
    #[Optional]
    public ?int $unapproved;

    /**
     * Rewards that are approved but not fulfilled.
     */
    #[Optional]
    public ?int $unfulfilled;

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
        ?int $completed = null,
        ?int $unapproved = null,
        ?int $unfulfilled = null,
    ): self
    {
        $self = new self;

        null !== $completed && $self['completed'] = $completed;
        null !== $unapproved && $self['unapproved'] = $unapproved;
        null !== $unfulfilled && $self['unfulfilled'] = $unfulfilled;

        return $self;
    }

    /**
     * Approved rewards that are fulfilled.
     */
    public function withCompleted(int $completed): self
    {
        $self = clone $this;
        $self['completed'] = $completed;

        return $self;
    }

    /**
     * Unapproved rewards awaiting review.
     */
    public function withUnapproved(int $unapproved): self
    {
        $self = clone $this;
        $self['unapproved'] = $unapproved;

        return $self;
    }

    /**
     * Rewards that are approved but not fulfilled.
     */
    public function withUnfulfilled(int $unfulfilled): self
    {
        $self = clone $this;
        $self['unfulfilled'] = $unfulfilled;

        return $self;
    }
}
