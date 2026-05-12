<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Creates a participant-scoped token for GrowSurf mobile SDK participant endpoints. The program must have mobile SDK access enabled.
 *
 * @see Growsurf\Services\Campaign\ParticipantService::createMobileToken()
 *
 * @phpstan-type ParticipantCreateMobileTokenParamsShape = array{id: string}
 */
final class ParticipantCreateMobileTokenParams implements BaseModel
{
    /** @use SdkModel<ParticipantCreateMobileTokenParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * `new ParticipantCreateMobileTokenParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantCreateMobileTokenParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantCreateMobileTokenParams)->withID(...)
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
