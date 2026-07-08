<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\ParticipantBulkDeleteResponse;

use Growsurf\Campaign\Participant\ParticipantBulkDeleteResponse\Result\Status;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type ResultShape = array{
 *   identifier: string,
 *   index: int,
 *   status: Status|value-of<Status>,
 *   email?: string|null,
 *   message?: string|null,
 *   participantID?: string|null,
 * }
 */
final class Result implements BaseModel
{
    /** @use SdkModel<ResultShape> */
    use SdkModel;

    /**
     * The submitted participant ID or email address, echoed back as received.
     */
    #[Required]
    public string $identifier;

    /**
     * Zero-based position of this entry in the submitted `participants` array.
     */
    #[Required]
    public int $index;

    /**
     * Per-row outcome. `DELETED` — the participant was resolved and removed. `NOT_FOUND` — no participant matches the ID or email. `DUPLICATE` — the entry resolves to the same participant as an earlier entry in the same request. `ERROR` — the lookup or deletion failed for this row.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * The resolved participant's email address. Present on `DELETED` rows.
     */
    #[Optional]
    public ?string $email;

    /**
     * Human-readable detail for `NOT_FOUND`, `DUPLICATE`, and `ERROR` rows.
     */
    #[Optional]
    public ?string $message;

    /**
     * The resolved GrowSurf participant ID. Present when the entry resolved to a participant.
     */
    #[Optional('participantId')]
    public ?string $participantID;

    /**
     * `new Result()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Result::with(identifier: ..., index: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Result)->withIdentifier(...)->withIndex(...)->withStatus(...)
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
    public static function with(
        string $identifier,
        int $index,
        Status|string $status,
        ?string $email = null,
        ?string $message = null,
        ?string $participantID = null,
    ): self {
        $self = new self;

        $self['identifier'] = $identifier;
        $self['index'] = $index;
        $self['status'] = $status;

        null !== $email && $self['email'] = $email;
        null !== $message && $self['message'] = $message;
        null !== $participantID && $self['participantID'] = $participantID;

        return $self;
    }

    /**
     * The submitted participant ID or email address, echoed back as received.
     */
    public function withIdentifier(string $identifier): self
    {
        $self = clone $this;
        $self['identifier'] = $identifier;

        return $self;
    }

    /**
     * Zero-based position of this entry in the submitted `participants` array.
     */
    public function withIndex(int $index): self
    {
        $self = clone $this;
        $self['index'] = $index;

        return $self;
    }

    /**
     * Per-row outcome. `DELETED` — the participant was resolved and removed. `NOT_FOUND` — no participant matches the ID or email. `DUPLICATE` — the entry resolves to the same participant as an earlier entry in the same request. `ERROR` — the lookup or deletion failed for this row.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * The resolved participant's email address. Present on `DELETED` rows.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * Human-readable detail for `NOT_FOUND`, `DUPLICATE`, and `ERROR` rows.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * The resolved GrowSurf participant ID. Present when the entry resolved to a participant.
     */
    public function withParticipantID(string $participantID): self
    {
        $self = clone $this;
        $self['participantID'] = $participantID;

        return $self;
    }
}
