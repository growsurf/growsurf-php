<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\ParticipantBulkMoveResponse;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Counts of submitted, moved, not-found, duplicate, and failed entries.
 *
 * @phpstan-type SummaryShape = array{
 *   total: int,
 *   groupID: string|null,
 *   movedCount: int,
 *   notFoundCount: int,
 *   duplicateCount: int,
 *   errorCount: int,
 * }
 */
final class Summary implements BaseModel
{
    /** @use SdkModel<SummaryShape> */
    use SdkModel;

    /** Number of entries submitted in this request. */
    #[Required]
    public int $total;

    /** The target group, or `null` for Default. */
    #[Required('groupId', nullable: true)]
    public ?string $groupID;

    /** Entries that resolved to a participant and were moved. */
    #[Required]
    public int $movedCount;

    /** Entries that did not match any participant. */
    #[Required]
    public int $notFoundCount;

    /** Entries that resolved to the same participant as an earlier entry. */
    #[Required]
    public int $duplicateCount;

    /** Entries that failed to look up. */
    #[Required]
    public int $errorCount;

    public function __construct()
    {
        $this->initialize();
    }
}
