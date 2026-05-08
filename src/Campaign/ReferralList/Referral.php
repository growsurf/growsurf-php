<?php

declare(strict_types=1);

namespace Growsurf\Campaign\ReferralList;

use Growsurf\Campaign\Participant\ReferralStatus;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type ReferralShape = array{
 *   id: string,
 *   createdAt: int,
 *   email: string,
 *   referralStatus: ReferralStatus|value-of<ReferralStatus>,
 *   referredBy: string,
 *   updatedAt: int,
 *   firstName?: string|null,
 *   lastName?: string|null,
 * }
 */
final class Referral implements BaseModel
{
    /** @use SdkModel<ReferralShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required]
    public int $createdAt;

    #[Required]
    public string $email;

    /** @var value-of<ReferralStatus> $referralStatus */
    #[Required(enum: ReferralStatus::class)]
    public string $referralStatus;

    #[Required]
    public string $referredBy;

    #[Required]
    public int $updatedAt;

    #[Optional(nullable: true)]
    public ?string $firstName;

    #[Optional(nullable: true)]
    public ?string $lastName;

    /**
     * `new Referral()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Referral::with(
     *   id: ...,
     *   createdAt: ...,
     *   email: ...,
     *   referralStatus: ...,
     *   referredBy: ...,
     *   updatedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Referral)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withEmail(...)
     *   ->withReferralStatus(...)
     *   ->withReferredBy(...)
     *   ->withUpdatedAt(...)
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
     * @param ReferralStatus|value-of<ReferralStatus> $referralStatus
     */
    public static function with(
        string $id,
        int $createdAt,
        string $email,
        ReferralStatus|string $referralStatus,
        string $referredBy,
        int $updatedAt,
        ?string $firstName = null,
        ?string $lastName = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['email'] = $email;
        $self['referralStatus'] = $referralStatus;
        $self['referredBy'] = $referredBy;
        $self['updatedAt'] = $updatedAt;

        null !== $firstName && $self['firstName'] = $firstName;
        null !== $lastName && $self['lastName'] = $lastName;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withCreatedAt(int $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * @param ReferralStatus|value-of<ReferralStatus> $referralStatus
     */
    public function withReferralStatus(
        ReferralStatus|string $referralStatus
    ): self {
        $self = clone $this;
        $self['referralStatus'] = $referralStatus;

        return $self;
    }

    public function withReferredBy(string $referredBy): self
    {
        $self = clone $this;
        $self['referredBy'] = $referredBy;

        return $self;
    }

    public function withUpdatedAt(int $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    public function withFirstName(?string $firstName): self
    {
        $self = clone $this;
        $self['firstName'] = $firstName;

        return $self;
    }

    public function withLastName(?string $lastName): self
    {
        $self = clone $this;
        $self['lastName'] = $lastName;

        return $self;
    }
}
