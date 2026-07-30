<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Campaign\AffiliateInvite\Status;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type AffiliateInviteShape = array{
 *   id?: string|null,
 *   acceptedAt?: int|null,
 *   createdAt?: int|null,
 *   email?: string|null,
 *   expiresAt?: int|null,
 *   firstName?: string|null,
 *   lastName?: string|null,
 *   lastSentAt?: int|null,
 *   revokedAt?: int|null,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class AffiliateInvite implements BaseModel
{
    /** @use SdkModel<AffiliateInviteShape> */
    use SdkModel;

    /**
     * Invite ID.
     */
    #[Optional]
    public ?string $id;

    /**
     * When the invite was accepted, in Unix milliseconds. `null` until accepted.
     */
    #[Optional(nullable: true)]
    public ?int $acceptedAt;

    /**
     * When the invite was created, in Unix milliseconds.
     */
    #[Optional]
    public ?int $createdAt;

    /**
     * Invitee email address.
     */
    #[Optional]
    public ?string $email;

    /**
     * When the emailed accept link stops working, in Unix milliseconds.
     */
    #[Optional]
    public ?int $expiresAt;

    /**
     * Invitee first name, when provided.
     */
    #[Optional(nullable: true)]
    public ?string $firstName;

    /**
     * Invitee last name, when provided.
     */
    #[Optional(nullable: true)]
    public ?string $lastName;

    /**
     * When the invite email was last sent, in Unix milliseconds.
     */
    #[Optional]
    public ?int $lastSentAt;

    /**
     * When the invite was revoked, in Unix milliseconds. `null` unless revoked.
     */
    #[Optional(nullable: true)]
    public ?int $revokedAt;

    /**
     * The invite's lifecycle state. Accepting a pending invite enrolls the invitee as an approved affiliate.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        ?string $id = null,
        ?int $acceptedAt = null,
        ?int $createdAt = null,
        ?string $email = null,
        ?int $expiresAt = null,
        ?string $firstName = null,
        ?string $lastName = null,
        ?int $lastSentAt = null,
        ?int $revokedAt = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $acceptedAt && $self['acceptedAt'] = $acceptedAt;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $email && $self['email'] = $email;
        null !== $expiresAt && $self['expiresAt'] = $expiresAt;
        null !== $firstName && $self['firstName'] = $firstName;
        null !== $lastName && $self['lastName'] = $lastName;
        null !== $lastSentAt && $self['lastSentAt'] = $lastSentAt;
        null !== $revokedAt && $self['revokedAt'] = $revokedAt;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * Invite ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * When the invite was accepted, in Unix milliseconds. `null` until accepted.
     */
    public function withAcceptedAt(?int $acceptedAt): self
    {
        $self = clone $this;
        $self['acceptedAt'] = $acceptedAt;

        return $self;
    }

    /**
     * When the invite was created, in Unix milliseconds.
     */
    public function withCreatedAt(int $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Invitee email address.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * When the emailed accept link stops working, in Unix milliseconds.
     */
    public function withExpiresAt(int $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * Invitee first name, when provided.
     */
    public function withFirstName(?string $firstName): self
    {
        $self = clone $this;
        $self['firstName'] = $firstName;

        return $self;
    }

    /**
     * Invitee last name, when provided.
     */
    public function withLastName(?string $lastName): self
    {
        $self = clone $this;
        $self['lastName'] = $lastName;

        return $self;
    }

    /**
     * When the invite email was last sent, in Unix milliseconds.
     */
    public function withLastSentAt(int $lastSentAt): self
    {
        $self = clone $this;
        $self['lastSentAt'] = $lastSentAt;

        return $self;
    }

    /**
     * When the invite was revoked, in Unix milliseconds. `null` unless revoked.
     */
    public function withRevokedAt(?int $revokedAt): self
    {
        $self = clone $this;
        $self['revokedAt'] = $revokedAt;

        return $self;
    }

    /**
     * The invite's lifecycle state. Accepting a pending invite enrolls the invitee as an approved affiliate.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
