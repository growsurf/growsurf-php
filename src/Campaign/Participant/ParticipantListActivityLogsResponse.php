<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ParticipantActivityLogShape from \Growsurf\Campaign\Participant\ParticipantActivityLog
 *
 * @phpstan-type ParticipantListActivityLogsResponseShape = array{
 *   activityLogs: list<ParticipantActivityLog|ParticipantActivityLogShape>,
 *   limit: int,
 *   offset?: int|null,
 * }
 */
final class ParticipantListActivityLogsResponse implements BaseModel
{
    /** @use SdkModel<ParticipantListActivityLogsResponseShape> */
    use SdkModel;

    /** @var list<ParticipantActivityLog> $activityLogs */
    #[Required(list: ParticipantActivityLog::class)]
    public array $activityLogs;

    #[Required]
    public int $limit;

    /**
     * The offset for the next page, or null when there are no more logs.
     */
    #[Optional(nullable: true)]
    public ?int $offset;

    /**
     * `new ParticipantListActivityLogsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantListActivityLogsResponse::with(activityLogs: ..., limit: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantListActivityLogsResponse)
     *   ->withActivityLogs(...)
     *   ->withLimit(...)
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
     * @param list<ParticipantActivityLog|ParticipantActivityLogShape> $activityLogs
     */
    public static function with(
        array $activityLogs,
        int $limit,
        ?int $offset = null,
    ): self {
        $self = new self;

        $self['activityLogs'] = $activityLogs;
        $self['limit'] = $limit;

        null !== $offset && $self['offset'] = $offset;

        return $self;
    }

    /**
     * @param list<ParticipantActivityLog|ParticipantActivityLogShape> $activityLogs
     */
    public function withActivityLogs(array $activityLogs): self
    {
        $self = clone $this;
        $self['activityLogs'] = $activityLogs;

        return $self;
    }

    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * The offset for the next page, or null when there are no more logs.
     */
    public function withOffset(?int $offset): self
    {
        $self = clone $this;
        $self['offset'] = $offset;

        return $self;
    }
}
