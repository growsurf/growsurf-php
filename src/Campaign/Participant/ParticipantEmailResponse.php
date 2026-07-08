<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Campaign\Participant\ParticipantEmailResponse\Status;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type ParticipantEmailResponseShape = array{
 *   status: Status|value-of<Status>, success: bool
 * }
 */
final class ParticipantEmailResponse implements BaseModel
{
    /** @use SdkModel<ParticipantEmailResponseShape> */
    use SdkModel;

    /**
     * The email was accepted for delivery.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    #[Required]
    public bool $success;

    /**
     * `new ParticipantEmailResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantEmailResponse::with(status: ..., success: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantEmailResponse)->withStatus(...)->withSuccess(...)
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
     * The email was accepted for delivery.
     *
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
