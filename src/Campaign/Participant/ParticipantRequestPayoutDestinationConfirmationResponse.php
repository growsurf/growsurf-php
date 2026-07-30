<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Campaign\Participant\ParticipantRequestPayoutDestinationConfirmationResponse\Status;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type ParticipantRequestPayoutDestinationConfirmationResponseShape = array{
 *   expiresAt?: int|null,
 *   provider?: string|null,
 *   providerDisplayName?: string|null,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class ParticipantRequestPayoutDestinationConfirmationResponse implements BaseModel
{
    /** @use SdkModel<ParticipantRequestPayoutDestinationConfirmationResponseShape> */
    use SdkModel;

    /**
     * When the confirmation link expires, as a Unix timestamp in milliseconds.
     */
    #[Optional(nullable: true)]
    public ?int $expiresAt;

    /**
     * The provider the participant was asked to confirm.
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
     * Confirms the message was requested.
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
     * @param string|null $provider
     * @param Status|value-of<Status> $status
     */
    public static function with(
        ?int $expiresAt = null,
        ?string $provider = null,
        ?string $providerDisplayName = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        null !== $expiresAt && $self['expiresAt'] = $expiresAt;
        null !== $provider && $self['provider'] = $provider;
        null !== $providerDisplayName && $self['providerDisplayName'] = $providerDisplayName;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * When the confirmation link expires, as a Unix timestamp in milliseconds.
     */
    public function withExpiresAt(?int $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * The provider the participant was asked to confirm.
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
     * Confirms the message was requested.
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
