<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\ParticipantGetPayoutDestinationResponse;

use Growsurf\Campaign\Participant\ParticipantGetPayoutDestinationResponse\Destination\LegalEntityType;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type DestinationShape = array{
 *   claimEmail?: string|null,
 *   confirmedAt?: int|null,
 *   legalEntityType?: null|LegalEntityType|value-of<LegalEntityType>,
 *   needsRepairReason?: string|null,
 *   provider?: string|null,
 *   providerDisplayName?: string|null,
 *   status?: string|null,
 * }
 */
final class Destination implements BaseModel
{
    /** @use SdkModel<DestinationShape> */
    use SdkModel;

    /**
     * The confirmed payout email for this provider.
     */
    #[Optional(nullable: true)]
    public ?string $claimEmail;

    /**
     * When the destination was confirmed, as a Unix timestamp in milliseconds.
     */
    #[Optional(nullable: true)]
    public ?int $confirmedAt;

    /**
     * The legal recipient type the participant confirmed, if any.
     *
     * @var value-of<LegalEntityType>|null $legalEntityType
     */
    #[Optional(enum: LegalEntityType::class, nullable: true)]
    public ?string $legalEntityType;

    /**
     * When status is `NEEDS_REPAIR`, why (e.g. a bounced delivery).
     */
    #[Optional(nullable: true)]
    public ?string $needsRepairReason;

    /**
     * The payout provider this entry describes.
     *
     * @var string|null $provider
     */
    #[Optional]
    public ?string $provider;

    /**
     * The customer-facing provider name (e.g. "PayPal", "Wise").
     */
    #[Optional]
    public ?string $providerDisplayName;

    /**
     * The destination's current status: `NONE` (not set up), `PENDING_CONFIRMATION`, `CONFIRMED`, `ACTIVE`, `NEEDS_REPAIR`, or `EXPIRED`. Historical superseded or revoked destinations are projected as `NONE`.
     */
    #[Optional]
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
     * @param LegalEntityType|value-of<LegalEntityType>|null $legalEntityType
     * @param string|null $provider
     */
    public static function with(
        ?string $claimEmail = null,
        ?int $confirmedAt = null,
        LegalEntityType|string|null $legalEntityType = null,
        ?string $needsRepairReason = null,
        ?string $provider = null,
        ?string $providerDisplayName = null,
        ?string $status = null,
    ): self {
        $self = new self;

        null !== $claimEmail && $self['claimEmail'] = $claimEmail;
        null !== $confirmedAt && $self['confirmedAt'] = $confirmedAt;
        null !== $legalEntityType && $self['legalEntityType'] = $legalEntityType;
        null !== $needsRepairReason && $self['needsRepairReason'] = $needsRepairReason;
        null !== $provider && $self['provider'] = $provider;
        null !== $providerDisplayName && $self['providerDisplayName'] = $providerDisplayName;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * The confirmed payout email for this provider.
     */
    public function withClaimEmail(?string $claimEmail): self
    {
        $self = clone $this;
        $self['claimEmail'] = $claimEmail;

        return $self;
    }

    /**
     * When the destination was confirmed, as a Unix timestamp in milliseconds.
     */
    public function withConfirmedAt(?int $confirmedAt): self
    {
        $self = clone $this;
        $self['confirmedAt'] = $confirmedAt;

        return $self;
    }

    /**
     * The legal recipient type the participant confirmed, if any.
     *
     * @param LegalEntityType|value-of<LegalEntityType>|null $legalEntityType
     */
    public function withLegalEntityType(
        LegalEntityType|string|null $legalEntityType
    ): self {
        $self = clone $this;
        $self['legalEntityType'] = $legalEntityType;

        return $self;
    }

    /**
     * When status is `NEEDS_REPAIR`, why (e.g. a bounced delivery).
     */
    public function withNeedsRepairReason(?string $needsRepairReason): self
    {
        $self = clone $this;
        $self['needsRepairReason'] = $needsRepairReason;

        return $self;
    }

    /**
     * The payout provider this entry describes.
     *
     * @param string $provider
     */
    public function withProvider(string $provider): self
    {
        $self = clone $this;
        $self['provider'] = $provider;

        return $self;
    }

    /**
     * The customer-facing provider name (e.g. "PayPal", "Wise").
     */
    public function withProviderDisplayName(string $providerDisplayName): self
    {
        $self = clone $this;
        $self['providerDisplayName'] = $providerDisplayName;

        return $self;
    }

    /**
     * The destination's current status: `NONE` (not set up), `PENDING_CONFIRMATION`, `CONFIRMED`, `ACTIVE`, `NEEDS_REPAIR`, or `EXPIRED`. Historical superseded or revoked destinations are projected as `NONE`.
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
