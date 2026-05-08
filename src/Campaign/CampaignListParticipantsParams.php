<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Retrieves a paged list of participants in a program.
 *
 * @see Growsurf\Services\CampaignService::listParticipants()
 *
 * @phpstan-type CampaignListParticipantsParamsShape = array{
 *   limit?: int|null, nextID?: string|null
 * }
 */
final class CampaignListParticipantsParams implements BaseModel
{
    /** @use SdkModel<CampaignListParticipantsParamsShape> */
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

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?int $limit = null, ?string $nextID = null): self
    {
        $self = new self;

        null !== $limit && $self['limit'] = $limit;
        null !== $nextID && $self['nextID'] = $nextID;

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
