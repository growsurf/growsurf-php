<?php

declare(strict_types=1);

namespace Growsurf\Account;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Your GrowSurf account — profile and GrowSurf-team verification state.
 *
 * @phpstan-type AccountShape = array{
 *   id: string,
 *   email: string,
 *   verificationStatus: VerificationStatus|value-of<VerificationStatus>,
 *   company?: string|null,
 *   createdAt?: int|null,
 *   firstName?: string|null,
 *   lastName?: string|null,
 *   verificationRequestedAt?: int|null,
 * }
 */
final class Account implements BaseModel
{
    /** @use SdkModel<AccountShape> */
    use SdkModel;

    /**
     * The account's unique identifier.
     */
    #[Required]
    public string $id;

    #[Required]
    public string $email;

    /**
     * GrowSurf-team verification state. `VERIFIED` is required before a program can send participant emails.
     *
     * @var value-of<VerificationStatus> $verificationStatus
     */
    #[Required(enum: VerificationStatus::class)]
    public string $verificationStatus;

    #[Optional(nullable: true)]
    public ?string $company;

    /**
     * When the account was created, as a Unix timestamp in milliseconds.
     */
    #[Optional(nullable: true)]
    public ?int $createdAt;

    #[Optional(nullable: true)]
    public ?string $firstName;

    #[Optional(nullable: true)]
    public ?string $lastName;

    /**
     * When team verification was last requested, as a Unix timestamp in milliseconds.
     */
    #[Optional(nullable: true)]
    public ?int $verificationRequestedAt;

    /**
     * `new Account()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Account::with(id: ..., email: ..., verificationStatus: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Account)
     *   ->withID(...)
     *   ->withEmail(...)
     *   ->withVerificationStatus(...)
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
     * @param VerificationStatus|value-of<VerificationStatus> $verificationStatus
     */
    public static function with(
        string $id,
        string $email,
        VerificationStatus|string $verificationStatus,
        ?string $company = null,
        ?int $createdAt = null,
        ?string $firstName = null,
        ?string $lastName = null,
        ?int $verificationRequestedAt = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['email'] = $email;
        $self['verificationStatus'] = $verificationStatus;

        null !== $company && $self['company'] = $company;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $firstName && $self['firstName'] = $firstName;
        null !== $lastName && $self['lastName'] = $lastName;
        null !== $verificationRequestedAt && $self['verificationRequestedAt'] = $verificationRequestedAt;

        return $self;
    }

    /**
     * The account's unique identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * GrowSurf-team verification state. `VERIFIED` is required before a program can send participant emails.
     *
     * @param VerificationStatus|value-of<VerificationStatus> $verificationStatus
     */
    public function withVerificationStatus(
        VerificationStatus|string $verificationStatus,
    ): self {
        $self = clone $this;
        $self['verificationStatus'] = $verificationStatus;

        return $self;
    }

    public function withCompany(?string $company): self
    {
        $self = clone $this;
        $self['company'] = $company;

        return $self;
    }

    /**
     * When the account was created, as a Unix timestamp in milliseconds.
     */
    public function withCreatedAt(?int $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

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

    /**
     * When team verification was last requested, as a Unix timestamp in milliseconds.
     */
    public function withVerificationRequestedAt(
        ?int $verificationRequestedAt
    ): self {
        $self = clone $this;
        $self['verificationRequestedAt'] = $verificationRequestedAt;

        return $self;
    }
}
