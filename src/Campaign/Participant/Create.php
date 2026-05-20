<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Campaign\Participant\Create\ReferralStatus;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type CreateShape = array{
 *   email: string,
 *   fingerprint?: string|null,
 *   firstName?: string|null,
 *   ipAddress?: string|null,
 *   lastName?: string|null,
 *   metadata?: array<string,mixed>|null,
 *   mobileInstanceID?: string|null,
 *   referralStatus?: null|\Growsurf\Campaign\Participant\Create\ReferralStatus|value-of<\Growsurf\Campaign\Participant\Create\ReferralStatus>,
 *   referredBy?: string|null,
 * }
 */
final class Create implements BaseModel
{
    /** @use SdkModel<CreateShape> */
    use SdkModel;

    #[Required]
    public string $email;

    #[Optional]
    public ?string $fingerprint;

    #[Optional]
    public ?string $firstName;

    #[Optional]
    public ?string $ipAddress;

    #[Optional]
    public ?string $lastName;

    /**
     * Shallow custom metadata object.
     *
     * @var array<string,mixed>|null $metadata
     */
    #[Optional(map: 'mixed')]
    public ?array $metadata;

    /**
     * Optional app-install scoped identifier for native mobile anti-fraud. Recommended for mobile participant creation and mobile participant token flows.
     */
    #[Optional('mobileInstanceId')]
    public ?string $mobileInstanceID;

    /**
     * @var value-of<ReferralStatus>|null $referralStatus
     */
    #[Optional(enum: ReferralStatus::class)]
    public ?string $referralStatus;

    /**
     * Referrer participant ID or email address.
     */
    #[Optional]
    public ?string $referredBy;

    /**
     * `new Create()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Create::with(email: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Create)->withEmail(...)
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
     * @param array<string,mixed>|null $metadata
     * @param ReferralStatus|value-of<ReferralStatus>|null $referralStatus
     */
    public static function with(
        string $email,
        ?string $fingerprint = null,
        ?string $firstName = null,
        ?string $ipAddress = null,
        ?string $lastName = null,
        ?array $metadata = null,
        ?string $mobileInstanceID = null,
        ReferralStatus|string|null $referralStatus = null,
        ?string $referredBy = null,
    ): self {
        $self = new self;

        $self['email'] = $email;

        null !== $fingerprint && $self['fingerprint'] = $fingerprint;
        null !== $firstName && $self['firstName'] = $firstName;
        null !== $ipAddress && $self['ipAddress'] = $ipAddress;
        null !== $lastName && $self['lastName'] = $lastName;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $mobileInstanceID && $self['mobileInstanceID'] = $mobileInstanceID;
        null !== $referralStatus && $self['referralStatus'] = $referralStatus;
        null !== $referredBy && $self['referredBy'] = $referredBy;

        return $self;
    }

    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    public function withFingerprint(string $fingerprint): self
    {
        $self = clone $this;
        $self['fingerprint'] = $fingerprint;

        return $self;
    }

    public function withFirstName(string $firstName): self
    {
        $self = clone $this;
        $self['firstName'] = $firstName;

        return $self;
    }

    public function withIPAddress(string $ipAddress): self
    {
        $self = clone $this;
        $self['ipAddress'] = $ipAddress;

        return $self;
    }

    public function withLastName(string $lastName): self
    {
        $self = clone $this;
        $self['lastName'] = $lastName;

        return $self;
    }

    /**
     * Shallow custom metadata object.
     *
     * @param array<string,mixed> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Optional app-install scoped identifier for native mobile anti-fraud. Recommended for mobile participant creation and mobile participant token flows.
     */
    public function withMobileInstanceID(string $mobileInstanceID): self
    {
        $self = clone $this;
        $self['mobileInstanceID'] = $mobileInstanceID;

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

    /**
     * Referrer participant ID or email address.
     */
    public function withReferredBy(string $referredBy): self
    {
        $self = clone $this;
        $self['referredBy'] = $referredBy;

        return $self;
    }
}
