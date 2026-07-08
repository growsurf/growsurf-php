<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\ParticipantBulkDeleteResponse;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type SummaryShape = array{
 *   deletedCount: int,
 *   duplicateCount: int,
 *   errorCount: int,
 *   notFoundCount: int,
 *   total: int,
 * }
 */
final class Summary implements BaseModel
{
    /** @use SdkModel<SummaryShape> */
    use SdkModel;

    /**
     * Entries that resolved to a participant and were deleted.
     */
    #[Required]
    public int $deletedCount;

    /**
     * Entries that resolved to the same participant as an earlier entry.
     */
    #[Required]
    public int $duplicateCount;

    /**
     * Entries that failed to look up or delete.
     */
    #[Required]
    public int $errorCount;

    /**
     * Entries that did not match any participant.
     */
    #[Required]
    public int $notFoundCount;

    /**
     * Number of entries submitted in this request.
     */
    #[Required]
    public int $total;

    /**
     * `new Summary()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Summary::with(
     *   deletedCount: ...,
     *   duplicateCount: ...,
     *   errorCount: ...,
     *   notFoundCount: ...,
     *   total: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Summary)
     *   ->withDeletedCount(...)
     *   ->withDuplicateCount(...)
     *   ->withErrorCount(...)
     *   ->withNotFoundCount(...)
     *   ->withTotal(...)
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
    public static function with(
        int $deletedCount,
        int $duplicateCount,
        int $errorCount,
        int $notFoundCount,
        int $total,
    ): self {
        $self = new self;

        $self['deletedCount'] = $deletedCount;
        $self['duplicateCount'] = $duplicateCount;
        $self['errorCount'] = $errorCount;
        $self['notFoundCount'] = $notFoundCount;
        $self['total'] = $total;

        return $self;
    }

    /**
     * Entries that resolved to a participant and were deleted.
     */
    public function withDeletedCount(int $deletedCount): self
    {
        $self = clone $this;
        $self['deletedCount'] = $deletedCount;

        return $self;
    }

    /**
     * Entries that resolved to the same participant as an earlier entry.
     */
    public function withDuplicateCount(int $duplicateCount): self
    {
        $self = clone $this;
        $self['duplicateCount'] = $duplicateCount;

        return $self;
    }

    /**
     * Entries that failed to look up or delete.
     */
    public function withErrorCount(int $errorCount): self
    {
        $self = clone $this;
        $self['errorCount'] = $errorCount;

        return $self;
    }

    /**
     * Entries that did not match any participant.
     */
    public function withNotFoundCount(int $notFoundCount): self
    {
        $self = clone $this;
        $self['notFoundCount'] = $notFoundCount;

        return $self;
    }

    /**
     * Number of entries submitted in this request.
     */
    public function withTotal(int $total): self
    {
        $self = clone $this;
        $self['total'] = $total;

        return $self;
    }
}
