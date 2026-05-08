<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\ParticipantRecordTransactionResponse;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type UnionMember1Shape = array{
 *   commissionsCreated: int,
 *   duplicate: bool,
 *   duplicateFields: list<string>,
 *   matchingCommissionIDs: list<string>,
 *   message: string,
 *   success: bool,
 * }
 */
final class UnionMember1 implements BaseModel
{
    /** @use SdkModel<UnionMember1Shape> */
    use SdkModel;

    #[Required]
    public bool $duplicate = true;

    #[Required]
    public bool $success = false;

    #[Required]
    public int $commissionsCreated;

    /** @var list<string> $duplicateFields */
    #[Required(list: 'string')]
    public array $duplicateFields;

    /** @var list<string> $matchingCommissionIDs */
    #[Required('matchingCommissionIds', list: 'string')]
    public array $matchingCommissionIDs;

    #[Required]
    public string $message;

    /**
     * `new UnionMember1()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UnionMember1::with(
     *   commissionsCreated: ...,
     *   duplicateFields: ...,
     *   matchingCommissionIDs: ...,
     *   message: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UnionMember1)
     *   ->withCommissionsCreated(...)
     *   ->withDuplicateFields(...)
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
     * @param list<string> $duplicateFields
     * @param list<string> $matchingCommissionIDs
     */
    public static function with(
        int $commissionsCreated,
        array $duplicateFields,
        array $matchingCommissionIDs,
        string $message,
    ): self {
        $self = new self;

        $self['commissionsCreated'] = $commissionsCreated;
        $self['duplicateFields'] = $duplicateFields;
        $self['matchingCommissionIDs'] = $matchingCommissionIDs;
        $self['message'] = $message;

        return $self;
    }

    public function withCommissionsCreated(int $commissionsCreated): self
    {
        $self = clone $this;
        $self['commissionsCreated'] = $commissionsCreated;

        return $self;
    }

    public function withDuplicate(bool $duplicate): self
    {
        $self = clone $this;
        $self['duplicate'] = $duplicate;

        return $self;
    }

    /**
     * @param list<string> $duplicateFields
     */
    public function withDuplicateFields(array $duplicateFields): self
    {
        $self = clone $this;
        $self['duplicateFields'] = $duplicateFields;

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

    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }
}
