<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Campaign\CampaignCreateMobileParticipantTokenParams\ReferralStatus;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Creates or returns a participant using the same input behavior as Add Participant, then returns a participant-scoped token for GrowSurf mobile SDK participant endpoints. Use this endpoint from your backend after your mobile app authenticates a signed-in user. The program must have mobile SDK access enabled.
 *
 * @see Growsurf\Services\CampaignService::createMobileParticipantToken()
 *
 * @phpstan-type CampaignCreateMobileParticipantTokenParamsShape = array{
 *   email: string,
 *   fingerprint?: string|null,
 *   firstName?: string|null,
 *   ipAddress?: string|null,
 *   lastName?: string|null,
 *   metadata?: array<string,mixed>|null,
 *   referralStatus?: null|ReferralStatus|value-of<ReferralStatus>,
 *   referredBy?: string|null,
 * }
 */
final class CampaignCreateMobileParticipantTokenParams implements BaseModel
{
    /** @use SdkModel<CampaignCreateMobileParticipantTokenParamsShape> */
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

    /** @var value-of<ReferralStatus>|null $referralStatus */
    #[Optional(enum: ReferralStatus::class)]
    public ?string $referralStatus;

    /**
     * Referrer participant ID or email address.
     */
    #[Optional]
    public ?string $referredBy;

    /**
     * `new CampaignCreateMobileParticipantTokenParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CampaignCreateMobileParticipantTokenParams::with(email: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CampaignCreateMobileParticipantTokenParams)->withEmail(...)
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
