<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type ParticipantNewMobileTokenResponseShape = array{
 *   expiresIn: int, participantToken: string
 * }
 */
final class ParticipantNewMobileTokenResponse implements BaseModel
{
    /** @use SdkModel<ParticipantNewMobileTokenResponseShape> */
    use SdkModel;

    /**
     * Token lifetime in seconds.
     */
    #[Required]
    public int $expiresIn;

    /**
     * Participant-scoped bearer token for GrowSurf mobile SDK participant endpoints.
     */
    #[Required]
    public string $participantToken;

    /**
     * `new ParticipantNewMobileTokenResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantNewMobileTokenResponse::with(expiresIn: ..., participantToken: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantNewMobileTokenResponse)
     *   ->withExpiresIn(...)
     *   ->withParticipantToken(...)
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
    public static function with(int $expiresIn, string $participantToken): self
    {
        $self = new self;

        $self['expiresIn'] = $expiresIn;
        $self['participantToken'] = $participantToken;

        return $self;
    }

    /**
     * Token lifetime in seconds.
     */
    public function withExpiresIn(int $expiresIn): self
    {
        $self = clone $this;
        $self['expiresIn'] = $expiresIn;

        return $self;
    }

    /**
     * Participant-scoped bearer token for GrowSurf mobile SDK participant endpoints.
     */
    public function withParticipantToken(string $participantToken): self
    {
        $self = clone $this;
        $self['participantToken'] = $participantToken;

        return $self;
    }
}
