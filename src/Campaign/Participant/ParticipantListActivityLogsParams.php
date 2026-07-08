<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Returns a participant's activity logs, most recent first (offset/limit paginated).
 *
 * @see Growsurf\Services\Campaign\ParticipantService::listActivityLogs()
 *
 * @phpstan-type ParticipantListActivityLogsParamsShape = array{
 *   id: string, limit?: int|null, offset?: int|null
 * }
 */
final class ParticipantListActivityLogsParams implements BaseModel
{
    /** @use SdkModel<ParticipantListActivityLogsParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * Number of logs to return (1–100, default 20).
     */
    #[Optional]
    public ?int $limit;

    /**
     * Number of logs to skip.
     */
    #[Optional]
    public ?int $offset;

    /**
     * `new ParticipantListActivityLogsParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantListActivityLogsParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantListActivityLogsParams)->withID(...)
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
        string $id,
        ?int $limit = null,
        ?int $offset = null
    ): self {
        $self = new self;

        $self['id'] = $id;

        null !== $limit && $self['limit'] = $limit;
        null !== $offset && $self['offset'] = $offset;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Number of logs to return (1–100, default 20).
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Number of logs to skip.
     */
    public function withOffset(int $offset): self
    {
        $self = clone $this;
        $self['offset'] = $offset;

        return $self;
    }
}
