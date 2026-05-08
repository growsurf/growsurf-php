<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Reward;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type RewardDeleteResponseShape = array{success: bool}
 */
final class RewardDeleteResponse implements BaseModel
{
    /** @use SdkModel<RewardDeleteResponseShape> */
    use SdkModel;

    #[Required]
    public bool $success;

    /**
     * `new RewardDeleteResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RewardDeleteResponse::with(success: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RewardDeleteResponse)->withSuccess(...)
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
