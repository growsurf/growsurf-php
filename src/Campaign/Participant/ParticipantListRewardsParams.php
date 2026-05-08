<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Retrieves a paged list of rewards earned by a participant.
 *
 * @see Growsurf\Services\Campaign\ParticipantService::listRewards()
 *
 * @phpstan-type ParticipantListRewardsParamsShape = array{
 *   id: string, limit?: int|null, nextID?: string|null
 * }
 */
final class ParticipantListRewardsParams implements BaseModel
{
    /** @use SdkModel<ParticipantListRewardsParamsShape> */
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
     * `new ParticipantListRewardsParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantListRewardsParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantListRewardsParams)->withID(...)
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
        ?string $nextID = null
    ): self {
        $self = new self;

        $self['id'] = $id;

        null !== $limit && $self['limit'] = $limit;
        null !== $nextID && $self['nextID'] = $nextID;

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
}
