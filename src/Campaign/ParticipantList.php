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
 * @phpstan-type ParticipantListShape = array{
 *   limit: int,
 *   nextID: string|null,
 *   participants: list<Participant|ParticipantShape>,
 * }
 */
final class ParticipantList implements BaseModel
{
    /** @use SdkModel<ParticipantListShape> */
    use SdkModel;

    #[Required]
    public int $limit;

    #[Required('nextId')]
    public ?string $nextID;

    /** @var list<Participant> $participants */
    #[Required(list: Participant::class)]
    public array $participants;

    /**
     * `new ParticipantList()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantList::with(limit: ..., nextID: ..., participants: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantList)->withLimit(...)->withNextID(...)->withParticipants(...)
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
     * @param list<Participant|ParticipantShape> $participants
     */
    public static function with(
        int $limit,
        ?string $nextID,
        array $participants
    ): self {
        $self = new self;

        $self['limit'] = $limit;
        $self['nextID'] = $nextID;
        $self['participants'] = $participants;

        return $self;
    }

    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    public function withNextID(?string $nextID): self
    {
        $self = clone $this;
        $self['nextID'] = $nextID;

        return $self;
    }

    /**
     * @param list<Participant|ParticipantShape> $participants
     */
    public function withParticipants(array $participants): self
    {
        $self = clone $this;
        $self['participants'] = $participants;

        return $self;
    }
}
