<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Campaign\Participant\Participant;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ParticipantShape from \Growsurf\Campaign\Participant\Participant
 *
 * @phpstan-type CampaignNewMobileParticipantTokenResponseShape = array{
 *   expiresIn: int,
 *   isNew: bool,
 *   participant: Participant|ParticipantShape,
 *   participantToken: string,
 * }
 */
final class CampaignNewMobileParticipantTokenResponse implements BaseModel
{
    /** @use SdkModel<CampaignNewMobileParticipantTokenResponseShape> */
    use SdkModel;

    /**
     * Token lifetime in seconds.
     */
    #[Required]
    public int $expiresIn;

    /**
     * Whether this request created a new participant. Returns false when the participant already existed.
     */
    #[Required]
    public bool $isNew;

    #[Required]
    public Participant $participant;

    /**
     * Participant-scoped bearer token for GrowSurf mobile SDK participant endpoints.
     */
    #[Required]
    public string $participantToken;

    /**
     * `new CampaignNewMobileParticipantTokenResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CampaignNewMobileParticipantTokenResponse::with(
     *   expiresIn: ..., isNew: ..., participant: ..., participantToken: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CampaignNewMobileParticipantTokenResponse)
     *   ->withExpiresIn(...)
     *   ->withIsNew(...)
     *   ->withParticipant(...)
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
     *
     * @param Participant|ParticipantShape $participant
     */
    public static function with(
        int $expiresIn,
        bool $isNew,
        Participant|array $participant,
        string $participantToken,
    ): self {
        $self = new self;

        $self['expiresIn'] = $expiresIn;
        $self['isNew'] = $isNew;
        $self['participant'] = $participant;
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
     * Whether this request created a new participant. Returns false when the participant already existed.
     */
    public function withIsNew(bool $isNew): self
    {
        $self = clone $this;
        $self['isNew'] = $isNew;

        return $self;
    }

    /**
     * @param Participant|ParticipantShape $participant
     */
    public function withParticipant(Participant|array $participant): self
    {
        $self = clone $this;
        $self['participant'] = $participant;

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
