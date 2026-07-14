<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Reward;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Approves a manually approved reward earned by a participant. This requires `reward:write`. When the request also sets `fulfill` to `true`, it additionally requires `reward:fulfill`.
 *
 * @see Growsurf\Services\Campaign\RewardService::approve()
 *
 * @phpstan-type RewardApproveParamsShape = array{id: string, fulfill?: bool|null}
 */
final class RewardApproveParams implements BaseModel
{
    /** @use SdkModel<RewardApproveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * Set true to mark the reward as fulfilled after approval.
     */
    #[Optional]
    public ?bool $fulfill;

    /**
     * `new RewardApproveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RewardApproveParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RewardApproveParams)->withID(...)
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
     */
    public static function with(string $id, ?bool $fulfill = null): self
    {
        $self = new self;

        $self['id'] = $id;

        null !== $fulfill && $self['fulfill'] = $fulfill;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Set true to mark the reward as fulfilled after approval.
     */
    public function withFulfill(bool $fulfill): self
    {
        $self = clone $this;
        $self['fulfill'] = $fulfill;

        return $self;
    }
}
