<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Commission;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * **Affiliate programs only.** Removes a pending participant commission.
 *
 * @see Growsurf\Services\Campaign\CommissionService::delete()
 *
 * @phpstan-type CommissionDeleteParamsShape = array{id: string}
 */
final class CommissionDeleteParams implements BaseModel
{
    /** @use SdkModel<CommissionDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * `new CommissionDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CommissionDeleteParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CommissionDeleteParams)->withID(...)
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
