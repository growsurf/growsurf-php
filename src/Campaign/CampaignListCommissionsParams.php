<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Campaign\CampaignListCommissionsParams\Status;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Retrieves a paged list of all participant commissions in an affiliate program.
 *
 * @see Growsurf\Services\CampaignService::listCommissions()
 *
 * @phpstan-type CampaignListCommissionsParamsShape = array{
 *   limit?: int|null, nextID?: string|null, status?: null|Status|value-of<Status>
 * }
 */
final class CampaignListCommissionsParams implements BaseModel
{
    /** @use SdkModel<CampaignListCommissionsParamsShape> */
    use SdkModel;
    use SdkParams;

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
        ?int $limit = null,
        ?string $nextID = null,
        Status|string|null $status = null
    ): self {
        $self = new self;

        null !== $limit && $self['limit'] = $limit;
        null !== $nextID && $self['nextID'] = $nextID;
        null !== $status && $self['status'] = $status;

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
