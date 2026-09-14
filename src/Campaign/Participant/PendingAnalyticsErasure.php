<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type PendingAnalyticsErasureShape = array{status: string, operationId: string}
 */
final class PendingAnalyticsErasure implements BaseModel
{
    /** @use SdkModel<PendingAnalyticsErasureShape> */
    use SdkModel;

    /** Analytics erasure has been accepted but is not confirmed complete. */
    #[Required]
    public string $status;

    /** Opaque reference for support inquiries about this analytics erasure. */
    #[Required]
    public string $operationId;

    /**
     * `new PendingAnalyticsErasure()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PendingAnalyticsErasure::with(status: ..., operationId: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PendingAnalyticsErasure)->withStatus(...)->withOperationId(...)
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
    public static function with(string $status, string $operationId): self
    {
        $self = new self;

        $self['status'] = $status;
        $self['operationId'] = $operationId;

        return $self;
    }

    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    public function withOperationId(string $operationId): self
    {
        $self = clone $this;
        $self['operationId'] = $operationId;

        return $self;
    }
}
