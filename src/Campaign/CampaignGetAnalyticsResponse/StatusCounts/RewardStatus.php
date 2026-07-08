<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignGetAnalyticsResponse\StatusCounts;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Reward status counts. Present for every program.
 *
 * @phpstan-type RewardStatusShape = array{
 *   approved?: int|null, pending?: int|null
 * }
 */
final class RewardStatus implements BaseModel
{
    /** @use SdkModel<RewardStatusShape> */
    use SdkModel;

    #[Optional]
    public ?int $approved;

    /**
     * Unapproved rewards awaiting fulfillment.
     */
    #[Optional]
    public ?int $pending;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?int $approved = null, ?int $pending = null): self
    {
        $self = new self;

        null !== $approved && $self['approved'] = $approved;
        null !== $pending && $self['pending'] = $pending;

        return $self;
    }

    public function withApproved(int $approved): self
    {
        $self = clone $this;
        $self['approved'] = $approved;

        return $self;
    }

    /**
     * Unapproved rewards awaiting fulfillment.
     */
    public function withPending(int $pending): self
    {
        $self = clone $this;
        $self['pending'] = $pending;

        return $self;
    }
}
