<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Campaign\Participant\ParticipantUpdateParams\ReferralStatus;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Updates a participant by GrowSurf participant ID or email address.
 *
 * @see Growsurf\Services\Campaign\ParticipantService::update()
 *
 * @phpstan-type ParticipantUpdateParamsShape = array{
 *   id: string,
 *   email?: string|null,
 *   firstName?: string|null,
 *   lastName?: string|null,
 *   metadata?: array<string,mixed>|null,
 *   notes?: string|null,
 *   paypalEmail?: string|null,
 *   referralStatus?: null|\Growsurf\Campaign\Participant\ParticipantUpdateParams\ReferralStatus|value-of<\Growsurf\Campaign\Participant\ParticipantUpdateParams\ReferralStatus>,
 *   referredBy?: string|null,
 *   unsubscribed?: bool|null,
 *   vanityKeys?: list<string>|null,
 * }
 */
final class ParticipantUpdateParams implements BaseModel
{
    /** @use SdkModel<ParticipantUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    #[Optional]
    public ?string $email;

    #[Optional]
    public ?string $firstName;

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
     * Freeform internal notes about the participant (internal only, never exposed to participants).
     */
    #[Optional]
    public ?string $notes;

    /**
     * The participant's PayPal email address, used for affiliate payouts.
     */
    #[Optional]
    public ?string $paypalEmail;

    /**
     * @var value-of<ReferralStatus>|null $referralStatus
     */
    #[Optional(
        enum: ReferralStatus::class,
    )]
    public ?string $referralStatus;

    #[Optional]
    public ?string $referredBy;

    #[Optional]
    public ?bool $unsubscribed;

    /** @var list<string>|null $vanityKeys */
    #[Optional(list: 'string')]
    public ?array $vanityKeys;

    /**
     * `new ParticipantUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantUpdateParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantUpdateParams)->withID(...)
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
     * @param list<string>|null $vanityKeys
     */
    public static function with(
        string $id,
        ?string $email = null,
        ?string $firstName = null,
        ?string $lastName = null,
        ?array $metadata = null,
        ?string $notes = null,
        ?string $paypalEmail = null,
        ReferralStatus|string|null $referralStatus = null,
        ?string $referredBy = null,
        ?bool $unsubscribed = null,
        ?array $vanityKeys = null,
    ): self {
        $self = new self;

        $self['id'] = $id;

        null !== $email && $self['email'] = $email;
        null !== $firstName && $self['firstName'] = $firstName;
        null !== $lastName && $self['lastName'] = $lastName;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $notes && $self['notes'] = $notes;
        null !== $paypalEmail && $self['paypalEmail'] = $paypalEmail;
        null !== $referralStatus && $self['referralStatus'] = $referralStatus;
        null !== $referredBy && $self['referredBy'] = $referredBy;
        null !== $unsubscribed && $self['unsubscribed'] = $unsubscribed;
        null !== $vanityKeys && $self['vanityKeys'] = $vanityKeys;

        return $self;
    }

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

    public function withFirstName(string $firstName): self
    {
        $self = clone $this;
        $self['firstName'] = $firstName;

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
     * Freeform internal notes about the participant (internal only, never exposed to participants).
     */
    public function withNotes(string $notes): self
    {
        $self = clone $this;
        $self['notes'] = $notes;

        return $self;
    }

    /**
     * The participant's PayPal email address, used for affiliate payouts.
     */
    public function withPaypalEmail(string $paypalEmail): self
    {
        $self = clone $this;
        $self['paypalEmail'] = $paypalEmail;

        return $self;
    }

    /**
     * @param ReferralStatus|value-of<ReferralStatus> $referralStatus
     */
    public function withReferralStatus(
        ReferralStatus|string $referralStatus,
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

    public function withUnsubscribed(bool $unsubscribed): self
    {
        $self = clone $this;
        $self['unsubscribed'] = $unsubscribed;

        return $self;
    }

    /**
     * @param list<string> $vanityKeys
     */
    public function withVanityKeys(array $vanityKeys): self
    {
        $self = clone $this;
        $self['vanityKeys'] = $vanityKeys;

        return $self;
    }
}
