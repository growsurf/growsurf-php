<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\ParticipantGetPayoutDestinationResponse;

use Growsurf\Campaign\Participant\ParticipantGetPayoutDestinationResponse\Destination\LegalEntityType;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type DestinationShape = array{
 *   claimEmail: string|null,
 *   confirmedAt: int|null,
 *   legalEntityType: null|LegalEntityType|value-of<LegalEntityType>,
 *   needsRepairReason: string|null,
 *   provider: string,
 *   providerDisplayName: string,
 *   status: string,
 * }
 */
final class Destination implements BaseModel
{
    /** @use SdkModel<DestinationShape> */
    use SdkModel;

    /**
     * The confirmed payout email for this provider.
     */
    #[Required(nullable: true)]
    public ?string $claimEmail;

    /**
     * When the destination was confirmed, as a Unix timestamp in milliseconds.
     */
    #[Required(nullable: true)]
    public ?int $confirmedAt;

    /**
     * The legal recipient type the participant confirmed, if any.
     *
     * @var value-of<LegalEntityType>|null $legalEntityType
     */
    #[Required(enum: LegalEntityType::class, nullable: true)]
    public ?string $legalEntityType;

    /**
     * When status is `NEEDS_REPAIR`, why (e.g. a bounced delivery).
     */
    #[Required(nullable: true)]
    public ?string $needsRepairReason;

    /**
     * The payout provider this entry describes.
     */
    #[Required]
    public string $provider;

    /**
     * The customer-facing provider name (e.g. "PayPal", "Wise").
     */
    #[Required]
    public string $providerDisplayName;

    /**
     * The destination's current status: `NONE` (not set up), `PENDING_CONFIRMATION`, `CONFIRMED`, `ACTIVE`, `NEEDS_REPAIR`, or `EXPIRED`. Historical superseded or revoked destinations are projected as `NONE`.
     */
    #[Required]
    public string $status;

    /**
     * `new Destination()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Destination::with(
     *   claimEmail: ...,
     *   confirmedAt: ...,
     *   legalEntityType: ...,
     *   needsRepairReason: ...,
     *   provider: ...,
     *   providerDisplayName: ...,
     *   status: ...,
     * )
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
     * @param LegalEntityType|value-of<LegalEntityType>|null $legalEntityType
     */
    public static function with(
        ?string $claimEmail,
        ?int $confirmedAt,
        LegalEntityType|string|null $legalEntityType,
        ?string $needsRepairReason,
        string $provider,
        string $providerDisplayName,
        string $status,
    ): self {
        $self = new self;

        $self['claimEmail'] = $claimEmail;
        $self['confirmedAt'] = $confirmedAt;
        $self['legalEntityType'] = $legalEntityType;
        $self['needsRepairReason'] = $needsRepairReason;
        $self['provider'] = $provider;
        $self['providerDisplayName'] = $providerDisplayName;
        $self['status'] = $status;

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
