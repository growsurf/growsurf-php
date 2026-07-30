<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type AffiliateInviteShape from \Growsurf\Campaign\AffiliateInvite
 *
 * @phpstan-type AffiliateInviteListResponseShape = array{
 *   invites: list<AffiliateInvite|AffiliateInviteShape>,
 *   total: int,
 *   limit?: int|null,
 *   offset?: int|null,
 * }
 */
final class AffiliateInviteListResponse implements BaseModel
{
    /** @use SdkModel<AffiliateInviteListResponseShape> */
    use SdkModel;

    /**
     * One page of the program's invites, newest first.
     *
     * @var list<AffiliateInvite> $invites
     */
    #[Required(list: AffiliateInvite::class)]
    public array $invites;

    /**
     * Total number of invites matching the filter.
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
     * `new AffiliateInviteListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AffiliateInviteListResponse::with(invites: ..., total: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AffiliateInviteListResponse)->withInvites(...)->withTotal(...)
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
     * @param list<AffiliateInvite|AffiliateInviteShape> $invites
     */
    public static function with(
        array $invites,
        int $total,
        ?int $limit = null,
        ?int $offset = null,
    ): self {
        $self = new self;

        $self['invites'] = $invites;
        $self['total'] = $total;

        null !== $limit && $self['limit'] = $limit;
        null !== $offset && $self['offset'] = $offset;

        return $self;
    }

    /**
     * One page of the program's invites, newest first.
     *
     * @param list<AffiliateInvite|AffiliateInviteShape> $invites
     */
    public function withInvites(array $invites): self
    {
        $self = clone $this;
        $self['invites'] = $invites;

        return $self;
    }

    /**
     * Total number of invites matching the filter.
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
