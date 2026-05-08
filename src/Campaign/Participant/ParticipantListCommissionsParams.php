<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Campaign\Participant\ParticipantListCommissionsParams\Status;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Retrieves a paged list of commissions earned by a participant.
 *
 * @see Growsurf\Services\Campaign\ParticipantService::listCommissions()
 *
 * @phpstan-type ParticipantListCommissionsParamsShape = array{
 *   id: string,
 *   limit?: int|null,
 *   nextID?: string|null,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class ParticipantListCommissionsParams implements BaseModel
{
    /** @use SdkModel<ParticipantListCommissionsParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * Number of results to return. Maximum 100.
     */
    #[Optional]
    public ?int $limit;

    /**
     * ID to start the next paged result set with.
     */
    #[Optional]
    public ?string $nextID;

    /**
     * Participant commission status.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    /**
     * `new ParticipantListCommissionsParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantListCommissionsParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantListCommissionsParams)->withID(...)
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
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        string $id,
        ?int $limit = null,
        ?string $nextID = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        $self['id'] = $id;

        null !== $limit && $self['limit'] = $limit;
        null !== $nextID && $self['nextID'] = $nextID;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Number of results to return. Maximum 100.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * ID to start the next paged result set with.
     */
    public function withNextID(string $nextID): self
    {
        $self = clone $this;
        $self['nextID'] = $nextID;

        return $self;
    }

    /**
     * Participant commission status.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
