<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\ParticipantBulkMoveResponse;

use Growsurf\Campaign\Participant\ParticipantBulkMoveResponse\Result\Status;
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

    /** The submitted participant ID or email address, echoed back as received. */
    #[Required]
    public string $identifier;

    /** Zero-based position of this entry in the submitted `participants` array. */
    #[Required]
    public int $index;

    /**
     * Per-row outcome. `MOVED` — the participant was resolved and is now in the target group. `NOT_FOUND` — no participant matches the ID or email. `DUPLICATE` — the entry resolves to the same participant as an earlier entry in the same request. `ERROR` — the lookup failed for this row.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /** The resolved participant's email address. Present on `MOVED` rows. */
    #[Optional(nullable: true)]
    public ?string $email;

    /** Human-readable detail for `NOT_FOUND`, `DUPLICATE`, and `ERROR` rows. */
    #[Optional]
    public ?string $message;

    /** The resolved GrowSurf participant ID. Present when the entry resolved to a participant. */
    #[Optional('participantId')]
    public ?string $participantID;

    public function __construct()
    {
        $this->initialize();
    }
}
