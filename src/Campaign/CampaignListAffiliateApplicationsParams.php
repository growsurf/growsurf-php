<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Campaign\CampaignListAffiliateApplicationsParams\Status;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Lists an affiliate program's applications, newest first. Applications exist on programs that review public signups (an `affiliateApplicationMode` of `MANUAL_REVIEW` or `AUTO_APPROVE`). A pending applicant is not a participant until their application is approved.
 *
 * @see Growsurf\Services\CampaignService::listAffiliateApplications()
 *
 * @phpstan-type CampaignListAffiliateApplicationsParamsShape = array{
 *   limit?: int|null, offset?: int|null, status?: null|Status|value-of<Status>
 * }
 */
final class CampaignListAffiliateApplicationsParams implements BaseModel
{
    /** @use SdkModel<CampaignListAffiliateApplicationsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * How many applications to return per page (1-100).
     */
    #[Optional]
    public ?int $limit;

    /**
     * Offset number used to skip through a result set.
     */
    #[Optional]
    public ?int $offset;

    /**
     * Only return applications with this status.
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
        ?int $offset = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        null !== $limit && $self['limit'] = $limit;
        null !== $offset && $self['offset'] = $offset;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * How many applications to return per page (1-100).
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Offset number used to skip through a result set.
     */
    public function withOffset(int $offset): self
    {
        $self = clone $this;
        $self['offset'] = $offset;

        return $self;
    }

    /**
     * Only return applications with this status.
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
