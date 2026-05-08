<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Retrieves a single participant by GrowSurf participant ID or email address.
 *
 * @see Growsurf\Services\Campaign\ParticipantService::retrieve()
 *
 * @phpstan-type ParticipantRetrieveParamsShape = array{id: string}
 */
final class ParticipantRetrieveParams implements BaseModel
{
    /** @use SdkModel<ParticipantRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * `new ParticipantRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantRetrieveParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantRetrieveParams)->withID(...)
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
