<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Campaign\Participant\ParticipantRefundTransactionResponse\AmendmentType;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type ParticipantRefundTransactionResponseShape = array{
 *   success: bool,
 *   amendmentType: AmendmentType|value-of<AmendmentType>,
 *   matched: int,
 *   reversed: int,
 *   adjusted: int,
 *   deleted: int,
 *   matchingCommissionIDs: list<string>,
 *   message: string,
 *   notFound?: bool|null,
 * }
 */
final class ParticipantRefundTransactionResponse implements BaseModel
{
    /** @use SdkModel<ParticipantRefundTransactionResponseShape> */
    use SdkModel;

    /**
     * true when the amendment was processed (including the tax-only case for already-paid commissions); false when no matching transaction was found.
     */
    #[Required]
    public bool $success;

    /** @var value-of<AmendmentType> $amendmentType */
    #[Required(enum: AmendmentType::class)]
    public string $amendmentType;

    /**
     * Number of commissions found for the provided identifiers.
     */
    #[Required]
    public int $matched;

    /**
     * Number of commissions reversed (set to zero amount).
     */
    #[Required]
    public int $reversed;

    /**
     * Number of commissions partially adjusted.
     */
    #[Required]
    public int $adjusted;

    #[Required]
    public int $deleted;

    /** @var list<string> $matchingCommissionIDs */
    #[Required('matchingCommissionIds', list: 'string')]
    public array $matchingCommissionIDs;

    #[Required]
    public string $message;

    /**
     * Present and true when no commission matched the provided identifiers.
     */
    #[Optional]
    public ?bool $notFound;

    /**
     * `new ParticipantRefundTransactionResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantRefundTransactionResponse::with(
     *   success: ...,
     *   amendmentType: ...,
     *   matched: ...,
     *   reversed: ...,
     *   adjusted: ...,
     *   deleted: ...,
     *   matchingCommissionIDs: ...,
     *   message: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantRefundTransactionResponse)
     *   ->withSuccess(...)
     *   ->withAmendmentType(...)
     *   ->withMatched(...)
     *   ->withReversed(...)
     *   ->withAdjusted(...)
     *   ->withDeleted(...)
     *   ->withMatchingCommissionIDs(...)
     *   ->withMessage(...)
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
     * @param AmendmentType|value-of<AmendmentType> $amendmentType
     * @param list<string> $matchingCommissionIDs
     */
    public static function with(
        bool $success,
        AmendmentType|string $amendmentType,
        int $matched,
        int $reversed,
        int $adjusted,
        int $deleted,
        array $matchingCommissionIDs,
        string $message,
        ?bool $notFound = null,
    ): self {
        $self = new self;

        $self['success'] = $success;
        $self['amendmentType'] = $amendmentType;
        $self['matched'] = $matched;
        $self['reversed'] = $reversed;
        $self['adjusted'] = $adjusted;
        $self['deleted'] = $deleted;
        $self['matchingCommissionIDs'] = $matchingCommissionIDs;
        $self['message'] = $message;

        null !== $notFound && $self['notFound'] = $notFound;

        return $self;
    }

    /**
     * true when the amendment was processed (including the tax-only case for already-paid commissions); false when no matching transaction was found.
     */
    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }

    /**
     * @param AmendmentType|value-of<AmendmentType> $amendmentType
     */
    public function withAmendmentType(AmendmentType|string $amendmentType): self
    {
        $self = clone $this;
        $self['amendmentType'] = $amendmentType;

        return $self;
    }

    /**
     * Number of commissions found for the provided identifiers.
     */
    public function withMatched(int $matched): self
    {
        $self = clone $this;
        $self['matched'] = $matched;

        return $self;
    }

    /**
     * Number of commissions reversed (set to zero amount).
     */
    public function withReversed(int $reversed): self
    {
        $self = clone $this;
        $self['reversed'] = $reversed;

        return $self;
    }

    /**
     * Number of commissions partially adjusted.
     */
    public function withAdjusted(int $adjusted): self
    {
        $self = clone $this;
        $self['adjusted'] = $adjusted;

        return $self;
    }

    public function withDeleted(int $deleted): self
    {
        $self = clone $this;
        $self['deleted'] = $deleted;

        return $self;
    }

    /**
     * @param list<string> $matchingCommissionIDs
     */
    public function withMatchingCommissionIDs(
        array $matchingCommissionIDs
    ): self {
        $self = clone $this;
        $self['matchingCommissionIDs'] = $matchingCommissionIDs;

        return $self;
    }

    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * Present and true when no commission matched the provided identifiers.
     */
    public function withNotFound(bool $notFound): self
    {
        $self = clone $this;
        $self['notFound'] = $notFound;

        return $self;
    }
}
