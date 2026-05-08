<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Campaign\ParticipantPayoutList\Payout;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type PayoutShape from \Growsurf\Campaign\ParticipantPayoutList\Payout
 *
 * @phpstan-type ParticipantPayoutListShape = array{
 *   limit: int, nextID: string|null, payouts: list<Payout|PayoutShape>
 * }
 */
final class ParticipantPayoutList implements BaseModel
{
    /** @use SdkModel<ParticipantPayoutListShape> */
    use SdkModel;

    #[Required]
    public int $limit;

    #[Required('nextId')]
    public ?string $nextID;

    /** @var list<Payout> $payouts */
    #[Required(list: Payout::class)]
    public array $payouts;

    /**
     * `new ParticipantPayoutList()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantPayoutList::with(limit: ..., nextID: ..., payouts: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantPayoutList)->withLimit(...)->withNextID(...)->withPayouts(...)
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
     * @param list<Payout|PayoutShape> $payouts
     */
    public static function with(
        int $limit,
        ?string $nextID,
        array $payouts
    ): self {
        $self = new self;

        $self['limit'] = $limit;
        $self['nextID'] = $nextID;
        $self['payouts'] = $payouts;

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

    /**
     * @param list<Payout|PayoutShape> $payouts
     */
    public function withPayouts(array $payouts): self
    {
        $self = clone $this;
        $self['payouts'] = $payouts;

        return $self;
    }
}
