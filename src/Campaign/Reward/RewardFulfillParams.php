<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Reward;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Marks an approved participant reward as fulfilled.
 *
 * @see Growsurf\Services\Campaign\RewardService::fulfill()
 *
 * @phpstan-type RewardFulfillParamsShape = array{id: string}
 */
final class RewardFulfillParams implements BaseModel
{
    /** @use SdkModel<RewardFulfillParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * `new RewardFulfillParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RewardFulfillParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RewardFulfillParams)->withID(...)
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
