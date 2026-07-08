<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Campaign\Participant\ParticipantBulkDeleteResponse\Result;
use Growsurf\Campaign\Participant\ParticipantBulkDeleteResponse\Summary;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ResultShape from \Growsurf\Campaign\Participant\ParticipantBulkDeleteResponse\Result
 * @phpstan-import-type SummaryShape from \Growsurf\Campaign\Participant\ParticipantBulkDeleteResponse\Summary
 *
 * @phpstan-type ParticipantBulkDeleteResponseShape = array{
 *   results: list<Result|ResultShape>, summary: Summary|SummaryShape
 * }
 */
final class ParticipantBulkDeleteResponse implements BaseModel
{
    /** @use SdkModel<ParticipantBulkDeleteResponseShape> */
    use SdkModel;

    /**
     * One entry per submitted identifier, in the same order as the request.
     *
     * @var list<Result> $results
     */
    #[Required(list: Result::class)]
    public array $results;

    #[Required]
    public Summary $summary;

    /**
     * `new ParticipantBulkDeleteResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantBulkDeleteResponse::with(results: ..., summary: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantBulkDeleteResponse)->withResults(...)->withSummary(...)
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
     * @param list<Result|ResultShape> $results
     * @param Summary|SummaryShape $summary
     */
    public static function with(array $results, Summary|array $summary): self
    {
        $self = new self;

        $self['results'] = $results;
        $self['summary'] = $summary;

        return $self;
    }

    /**
     * One entry per submitted identifier, in the same order as the request.
     *
     * @param list<Result|ResultShape> $results
     */
    public function withResults(array $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }

    /**
     * @param Summary|SummaryShape $summary
     */
    public function withSummary(Summary|array $summary): self
    {
        $self = clone $this;
        $self['summary'] = $summary;

        return $self;
    }
}
