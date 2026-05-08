<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Reward;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type RewardFulfillResponseShape = array{success: bool}
 */
final class RewardFulfillResponse implements BaseModel
{
    /** @use SdkModel<RewardFulfillResponseShape> */
    use SdkModel;

    #[Required]
    public bool $success;

    /**
     * `new RewardFulfillResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RewardFulfillResponse::with(success: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RewardFulfillResponse)->withSuccess(...)
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
    public static function with(bool $success): self
    {
        $self = new self;

        $self['success'] = $success;

        return $self;
    }

    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }
}
