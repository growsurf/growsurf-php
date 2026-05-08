<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Campaign\ParticipantCommissionList\Commission;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type CommissionShape from \Growsurf\Campaign\ParticipantCommissionList\Commission
 *
 * @phpstan-type ParticipantCommissionListShape = array{
 *   commissions: list<Commission|CommissionShape>, limit: int, nextID: string|null
 * }
 */
final class ParticipantCommissionList implements BaseModel
{
    /** @use SdkModel<ParticipantCommissionListShape> */
    use SdkModel;

    /** @var list<Commission> $commissions */
    #[Required(list: Commission::class)]
    public array $commissions;

    #[Required]
    public int $limit;

    #[Required('nextId')]
    public ?string $nextID;

    /**
     * `new ParticipantCommissionList()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantCommissionList::with(commissions: ..., limit: ..., nextID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantCommissionList)
     *   ->withCommissions(...)
     *   ->withLimit(...)
     *   ->withNextID(...)
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
     * @param list<Commission|CommissionShape> $commissions
     */
    public static function with(
        array $commissions,
        int $limit,
        ?string $nextID
    ): self {
        $self = new self;

        $self['commissions'] = $commissions;
        $self['limit'] = $limit;
        $self['nextID'] = $nextID;

        return $self;
    }

    /**
     * @param list<Commission|CommissionShape> $commissions
     */
    public function withCommissions(array $commissions): self
    {
        $self = clone $this;
        $self['commissions'] = $commissions;

        return $self;
    }

    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    public function withNextID(?string $nextID): self
    {
        $self = clone $this;
        $self['nextID'] = $nextID;

        return $self;
    }
}
