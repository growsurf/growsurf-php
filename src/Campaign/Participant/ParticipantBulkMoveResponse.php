<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Campaign\Participant\ParticipantBulkMoveResponse\Result;
use Growsurf\Campaign\Participant\ParticipantBulkMoveResponse\Summary;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ResultShape from \Growsurf\Campaign\Participant\ParticipantBulkMoveResponse\Result
 * @phpstan-import-type SummaryShape from \Growsurf\Campaign\Participant\ParticipantBulkMoveResponse\Summary
 *
 * @phpstan-type ParticipantBulkMoveResponseShape = array{
 *   results: list<Result|ResultShape>, summary: Summary|SummaryShape
 * }
 */
final class ParticipantBulkMoveResponse implements BaseModel
{
    /** @use SdkModel<ParticipantBulkMoveResponseShape> */
    use SdkModel;

    /**
     * One entry per submitted identifier, in the same order as the request.
     *
     * @var list<Result> $results
     */
    #[Required(list: Result::class)]
    public array $results;

    /** Counts of submitted, moved, not-found, duplicate, and failed entries. */
    #[Required]
    public Summary $summary;

    public function __construct()
    {
        $this->initialize();
    }
}
