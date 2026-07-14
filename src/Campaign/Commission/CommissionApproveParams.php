<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Commission;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * **Affiliate programs only.** Approves a pending participant commission so it can become eligible for payout.
 *
 * @see Growsurf\Services\Campaign\CommissionService::approve()
 *
 * @phpstan-type CommissionApproveParamsShape = array{id: string}
 */
final class CommissionApproveParams implements BaseModel
{
    /** @use SdkModel<CommissionApproveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * `new CommissionApproveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CommissionApproveParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CommissionApproveParams)->withID(...)
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
