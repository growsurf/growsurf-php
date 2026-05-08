<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type ParticipantDeleteResponseShape = array{success: bool}
 */
final class ParticipantDeleteResponse implements BaseModel
{
    /** @use SdkModel<ParticipantDeleteResponseShape> */
    use SdkModel;

    #[Required]
    public bool $success;

    /**
     * `new ParticipantDeleteResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantDeleteResponse::with(success: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantDeleteResponse)->withSuccess(...)
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
