<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Commission;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type CommissionApproveResponseShape = array{success: bool}
 */
final class CommissionApproveResponse implements BaseModel
{
    /** @use SdkModel<CommissionApproveResponseShape> */
    use SdkModel;

    #[Required]
    public bool $success;

    /**
     * `new CommissionApproveResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CommissionApproveResponse::with(success: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CommissionApproveResponse)->withSuccess(...)
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
