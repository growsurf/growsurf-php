<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\ParticipantRecordTransactionResponse;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type UnionMember0Shape = array{
 *   duplicate: bool, firstSale: bool, message: string, success: bool
 * }
 */
final class UnionMember0 implements BaseModel
{
    /** @use SdkModel<UnionMember0Shape> */
    use SdkModel;

    #[Required]
    public bool $duplicate = false;

    #[Required]
    public bool $success = true;

    #[Required]
    public bool $firstSale;

    #[Required]
    public string $message;

    /**
     * `new UnionMember0()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UnionMember0::with(firstSale: ..., message: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UnionMember0)->withFirstSale(...)->withMessage(...)
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
     */
    public static function with(bool $firstSale, string $message): self
    {
        $self = new self;

        $self['firstSale'] = $firstSale;
        $self['message'] = $message;

        return $self;
    }

    public function withDuplicate(bool $duplicate): self
    {
        $self = clone $this;
        $self['duplicate'] = $duplicate;

        return $self;
    }

    public function withFirstSale(bool $firstSale): self
    {
        $self = clone $this;
        $self['firstSale'] = $firstSale;

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
