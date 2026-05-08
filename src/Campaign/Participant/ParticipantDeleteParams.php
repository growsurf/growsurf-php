<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Removes a participant by GrowSurf participant ID or email address.
 *
 * @see Growsurf\Services\Campaign\ParticipantService::delete()
 *
 * @phpstan-type ParticipantDeleteParamsShape = array{id: string}
 */
final class ParticipantDeleteParams implements BaseModel
{
    /** @use SdkModel<ParticipantDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * `new ParticipantDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantDeleteParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantDeleteParams)->withID(...)
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
