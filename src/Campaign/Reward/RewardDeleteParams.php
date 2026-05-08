<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Reward;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Removes a manually approved participant reward that has not already been approved.
 *
 * @see Growsurf\Services\Campaign\RewardService::delete()
 *
 * @phpstan-type RewardDeleteParamsShape = array{id: string}
 */
final class RewardDeleteParams implements BaseModel
{
    /** @use SdkModel<RewardDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * `new RewardDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RewardDeleteParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RewardDeleteParams)->withID(...)
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
    public static function with(string $id): self
    {
        $self = new self;

        $self['id'] = $id;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }
}
