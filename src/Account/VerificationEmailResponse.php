<?php

declare(strict_types=1);

namespace Growsurf\Account;

use Growsurf\Account\VerificationEmailResponse\Status;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type VerificationEmailResponseShape = array{
 *   status: Status|value-of<Status>, success: bool
 * }
 */
final class VerificationEmailResponse implements BaseModel
{
    /** @use SdkModel<VerificationEmailResponseShape> */
    use SdkModel;

    /** @var value-of<Status> $status */
    #[Required(enum: Status::class)]
    public string $status;

    #[Required]
    public bool $success;

    /**
     * `new VerificationEmailResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VerificationEmailResponse::with(status: ..., success: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VerificationEmailResponse)->withStatus(...)->withSuccess(...)
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
     *
     * @param Status|value-of<Status> $status
     */
    public static function with(Status|string $status, bool $success): self
    {
        $self = new self;

        $self['status'] = $status;
        $self['success'] = $success;

        return $self;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }
}
