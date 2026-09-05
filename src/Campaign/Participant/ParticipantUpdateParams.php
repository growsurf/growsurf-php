<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Campaign\Participant\ParticipantUpdateParams\AffiliateStatus;
use Growsurf\Campaign\Participant\ParticipantUpdateParams\ReferralStatus;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Updates a participant by GrowSurf participant ID or email address. For affiliate programs, set `affiliateStatus` to `APPROVED`, `SUSPENDED`, or `BANNED`. `APPROVED` enrolls the participant as an affiliate. `SUSPENDED` and `BANNED` require an existing affiliate. This endpoint does not accept `isAffiliate`, and affiliate enrollment cannot be removed through REST.
 *
 * @see Growsurf\Services\Campaign\ParticipantService::update()
 *
 * @phpstan-type ParticipantUpdateParamsShape = array{
 *   id: string,
 *   affiliateStatus?: \Growsurf\Campaign\Participant\ParticipantUpdateParams\AffiliateStatus|value-of<\Growsurf\Campaign\Participant\ParticipantUpdateParams\AffiliateStatus>,
 *   email?: string,
 *   firstName?: string,
 *   lastName?: string,
 *   metadata?: array<string,mixed>,
 *   notes?: string,
 *   referralStatus?: \Growsurf\Campaign\Participant\ParticipantUpdateParams\ReferralStatus|value-of<\Growsurf\Campaign\Participant\ParticipantUpdateParams\ReferralStatus>,
 *   referredBy?: string,
 *   unsubscribed?: bool,
 *   vanityKeys?: list<string>,
 * }
 */
final class ParticipantUpdateParams implements BaseModel
{
    /** @use SdkModel<ParticipantUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * Affiliate programs only. Sets the affiliate status. `APPROVED` also enrolls a participant who is not yet an affiliate. `SUSPENDED` and `BANNED` are rejected for non-affiliates.
     *
     * @var value-of<AffiliateStatus>|null $affiliateStatus
     */
    #[Optional(
        enum: AffiliateStatus::class,
    )]
    public ?string $affiliateStatus;

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
     * @param AffiliateStatus|value-of<AffiliateStatus>|null $affiliateStatus
     * @param array<string,mixed>|null $metadata
     * @param ReferralStatus|value-of<ReferralStatus>|null $referralStatus
     * @param list<string>|null $vanityKeys
     */
    public static function with(
        string $id,
        AffiliateStatus|string|null $affiliateStatus = null,
        ?string $email = null,
        ?string $firstName = null,
        ?string $lastName = null,
        ?array $metadata = null,
        ?string $notes = null,
        ReferralStatus|string|null $referralStatus = null,
        ?string $referredBy = null,
        ?bool $unsubscribed = null,
        ?array $vanityKeys = null,
    ): self {
        $self = new self;

        $self['id'] = $id;

        null !== $affiliateStatus && $self['affiliateStatus'] = $affiliateStatus;
        null !== $email && $self['email'] = $email;
        null !== $firstName && $self['firstName'] = $firstName;
        null !== $lastName && $self['lastName'] = $lastName;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $notes && $self['notes'] = $notes;
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

    /**
     * Affiliate programs only. Sets the affiliate status. `APPROVED` also enrolls a participant who is not yet an affiliate. `SUSPENDED` and `BANNED` are rejected for non-affiliates.
     *
     * @param AffiliateStatus|value-of<AffiliateStatus> $affiliateStatus
     */
    public function withAffiliateStatus(
        AffiliateStatus|string $affiliateStatus,
    ): self {
        $self = clone $this;
        $self['affiliateStatus'] = $affiliateStatus;

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
