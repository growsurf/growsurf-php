<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type AffiliateApplicationShape from \Growsurf\Campaign\AffiliateApplication
 *
 * @phpstan-type AffiliateApplicationListResponseShape = array{
 *   applications: list<AffiliateApplication|AffiliateApplicationShape>,
 *   total: int,
 *   limit?: int|null,
 *   offset?: int|null,
 * }
 */
final class AffiliateApplicationListResponse implements BaseModel
{
    /** @use SdkModel<AffiliateApplicationListResponseShape> */
    use SdkModel;

    /**
     * One page of the program's applications, newest first.
     *
     * @var list<AffiliateApplication> $applications
     */
    #[Required(list: AffiliateApplication::class)]
    public array $applications;

    /**
     * Total number of applications matching the filter.
     */
    #[Required]
    public int $total;

    /**
     * The page size used.
     */
    #[Optional]
    public ?int $limit;

    /**
     * The offset this page started at.
     */
    #[Optional]
    public ?int $offset;

    /**
     * `new AffiliateApplicationListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AffiliateApplicationListResponse::with(applications: ..., total: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AffiliateApplicationListResponse)
     *   ->withApplications(...)
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
     *
     * @param list<AffiliateApplication|AffiliateApplicationShape> $applications
     */
    public static function with(
        array $applications,
        int $total,
        ?int $limit = null,
        ?int $offset = null,
    ): self {
        $self = new self;

        $self['applications'] = $applications;
        $self['total'] = $total;

        null !== $limit && $self['limit'] = $limit;
        null !== $offset && $self['offset'] = $offset;

        return $self;
    }

    /**
     * One page of the program's applications, newest first.
     *
     * @param list<AffiliateApplication|AffiliateApplicationShape> $applications
     */
    public function withApplications(array $applications): self
    {
        $self = clone $this;
        $self['applications'] = $applications;

        return $self;
    }

    /**
     * Total number of applications matching the filter.
     */
    public function withTotal(int $total): self
    {
        $self = clone $this;
        $self['total'] = $total;

        return $self;
    }

    /**
     * The page size used.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * The offset this page started at.
     */
    public function withOffset(int $offset): self
    {
        $self = clone $this;
        $self['offset'] = $offset;

        return $self;
    }
}
