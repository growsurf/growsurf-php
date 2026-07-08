<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Campaign\Participant\ParticipantAddParams\ReferralStatus;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Adds a new participant to the program. If the email already exists, the existing participant is returned.
 *
 * @see Growsurf\Services\Campaign\ParticipantService::add()
 *
 * @phpstan-type ParticipantAddParamsShape = array{
 *   email: string,
 *   fingerprint?: string|null,
 *   firstName?: string|null,
 *   ipAddress?: string|null,
 *   lastName?: string|null,
 *   metadata?: array<string,mixed>|null,
 *   mobileInstanceID?: string|null,
 *   referralStatus?: null|\Growsurf\Campaign\Participant\ParticipantAddParams\ReferralStatus|value-of<\Growsurf\Campaign\Participant\ParticipantAddParams\ReferralStatus>,
 *   referredBy?: string|null,
 * }
 */
final class ParticipantAddParams implements BaseModel
{
    /** @use SdkModel<ParticipantAddParamsShape> */
    use SdkModel;
    use SdkParams;

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
     * Optional app-install scoped identifier for native mobile anti-fraud. Recommended for mobile participant creation and mobile participant token flows. The official mobile SDKs generate this as a lowercase UUID.
     */
    #[Optional('mobileInstanceId')]
    public ?string $mobileInstanceID;

    /**
     * The referral credit status. Only meaningful when `referredBy` resolves to a referrer. When omitted, it is derived from the program's referral trigger (`CREDIT_AWARDED`, `CREDIT_PENDING`, or `CREDIT_EXPIRED`); left unset when no referrer resolves.
     *
     * @var value-of<ReferralStatus>|null $referralStatus
     */
    #[Optional(
        enum: ReferralStatus::class,
    )]
    public ?string $referralStatus;

    /**
     * Referrer participant ID or email address.
     */
    #[Optional]
    public ?string $referredBy;

    /**
     * `new ParticipantAddParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantAddParams::with(email: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantAddParams)->withEmail(...)
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
     * Optional app-install scoped identifier for native mobile anti-fraud. Recommended for mobile participant creation and mobile participant token flows. The official mobile SDKs generate this as a lowercase UUID.
     */
    public function withMobileInstanceID(string $mobileInstanceID): self
    {
        $self = clone $this;
        $self['mobileInstanceID'] = $mobileInstanceID;

        return $self;
    }

    /**
     * The referral credit status. Only meaningful when `referredBy` resolves to a referrer. When omitted, it is derived from the program's referral trigger (`CREDIT_AWARDED`, `CREDIT_PENDING`, or `CREDIT_EXPIRED`); left unset when no referrer resolves.
     *
     * @param ReferralStatus|value-of<ReferralStatus> $referralStatus
     */
    public function withReferralStatus(
        ReferralStatus|string $referralStatus,
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
