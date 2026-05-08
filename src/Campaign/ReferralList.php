<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Campaign\ReferralList\Referral;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ReferralShape from \Growsurf\Campaign\ReferralList\Referral
 *
 * @phpstan-type ReferralListShape = array{
 *   limit: int,
 *   more: bool,
 *   referrals: list<Referral|ReferralShape>,
 *   nextID?: string|null,
 *   nextOffset?: int|null,
 * }
 */
final class ReferralList implements BaseModel
{
    /** @use SdkModel<ReferralListShape> */
    use SdkModel;

    #[Required]
    public int $limit;

    #[Required]
    public bool $more;

    /** @var list<Referral> $referrals */
    #[Required(list: Referral::class)]
    public array $referrals;

    #[Optional('nextId', nullable: true)]
    public ?string $nextID;

    #[Optional(nullable: true)]
    public ?int $nextOffset;

    /**
     * `new ReferralList()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ReferralList::with(limit: ..., more: ..., referrals: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ReferralList)->withLimit(...)->withMore(...)->withReferrals(...)
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
     * @param list<Referral|ReferralShape> $referrals
     */
    public static function with(
        int $limit,
        bool $more,
        array $referrals,
        ?string $nextID = null,
        ?int $nextOffset = null,
    ): self {
        $self = new self;

        $self['limit'] = $limit;
        $self['more'] = $more;
        $self['referrals'] = $referrals;

        null !== $nextID && $self['nextID'] = $nextID;
        null !== $nextOffset && $self['nextOffset'] = $nextOffset;

        return $self;
    }

    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    public function withMore(bool $more): self
    {
        $self = clone $this;
        $self['more'] = $more;

        return $self;
    }

    /**
     * @param list<Referral|ReferralShape> $referrals
     */
    public function withReferrals(array $referrals): self
    {
        $self = clone $this;
        $self['referrals'] = $referrals;

        return $self;
    }

    public function withNextID(?string $nextID): self
    {
        $self = clone $this;
        $self['nextID'] = $nextID;

        return $self;
    }

    public function withNextOffset(?int $nextOffset): self
    {
        $self = clone $this;
        $self['nextOffset'] = $nextOffset;

        return $self;
    }
}
