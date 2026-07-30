<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Campaign\Participant\ParticipantGetPayoutDestinationResponse\Destination;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type DestinationShape from \Growsurf\Campaign\Participant\ParticipantGetPayoutDestinationResponse\Destination
 *
 * @phpstan-type ParticipantGetPayoutDestinationResponseShape = array{
 *   activeProvider?: string|null,
 *   destinations?: list<Destination|DestinationShape>|null,
 *   enabledProviders?: list<string>|null,
 * }
 */
final class ParticipantGetPayoutDestinationResponse implements BaseModel
{
    /** @use SdkModel<ParticipantGetPayoutDestinationResponseShape> */
    use SdkModel;

    /**
     * The provider that currently gets paid, or null until the participant confirms one.
     *
     * @var string|null $activeProvider
     */
    #[Optional(nullable: true)]
    public ?string $activeProvider;

    /**
     * One entry per enabled payout provider describing the participant's destination for it.
     *
     * @var list<Destination>|null $destinations
     */
    #[Optional(list: Destination::class)]
    public ?array $destinations;

    /**
     * The payout providers enabled for this program.
     *
     * @var list<string>|null $enabledProviders
     */
    #[Optional(list: 'string')]
    public ?array $enabledProviders;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param string|null $activeProvider
     * @param list<Destination|DestinationShape>|null $destinations
     * @param list<string>|null $enabledProviders
     */
    public static function with(
        ?string $activeProvider = null,
        ?array $destinations = null,
        ?array $enabledProviders = null,
    ): self {
        $self = new self;

        null !== $activeProvider && $self['activeProvider'] = $activeProvider;
        null !== $destinations && $self['destinations'] = $destinations;
        null !== $enabledProviders && $self['enabledProviders'] = $enabledProviders;

        return $self;
    }

    /**
     * The provider that currently gets paid, or null until the participant confirms one.
     *
     * @param string|null $activeProvider
     */
    public function withActiveProvider(
        ?string $activeProvider
    ): self {
        $self = clone $this;
        $self['activeProvider'] = $activeProvider;

        return $self;
    }

    /**
     * One entry per enabled payout provider describing the participant's destination for it.
     *
     * @param list<Destination|DestinationShape> $destinations
     */
    public function withDestinations(array $destinations): self
    {
        $self = clone $this;
        $self['destinations'] = $destinations;

        return $self;
    }

    /**
     * The payout providers enabled for this program.
     *
     * @param list<string> $enabledProviders
     */
    public function withEnabledProviders(array $enabledProviders): self
    {
        $self = clone $this;
        $self['enabledProviders'] = $enabledProviders;

        return $self;
    }

}
