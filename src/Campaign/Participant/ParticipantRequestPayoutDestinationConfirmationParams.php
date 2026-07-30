<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Campaign\Participant\ParticipantRequestPayoutDestinationConfirmationParams\Provider;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Sends the participant a one-time link to confirm their payout destination for the chosen provider. Only the participant can open the link and confirm — this endpoint just triggers the message. The provider must be enabled for the program.
 *
 * @see Growsurf\Services\Campaign\ParticipantService::requestPayoutDestinationConfirmation()
 *
 * @phpstan-type ParticipantRequestPayoutDestinationConfirmationParamsShape = array{
 *   id: string, provider: Provider|value-of<Provider>
 * }
 */
final class ParticipantRequestPayoutDestinationConfirmationParams implements BaseModel
{
    /** @use SdkModel<ParticipantRequestPayoutDestinationConfirmationParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * The payout provider the participant should confirm a destination for.
     *
     * @var value-of<Provider> $provider
     */
    #[Required(enum: Provider::class)]
    public string $provider;

    /**
     * `new ParticipantRequestPayoutDestinationConfirmationParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantRequestPayoutDestinationConfirmationParams::with(
     *   id: ..., provider: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantRequestPayoutDestinationConfirmationParams)
     *   ->withID(...)
     *   ->withProvider(...)
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
     * @param Provider|value-of<Provider> $provider
     */
    public static function with(string $id, Provider|string $provider): self
    {
        $self = new self;

        $self['id'] = $id;
        $self['provider'] = $provider;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The payout provider the participant should confirm a destination for.
     *
     * @param Provider|value-of<Provider> $provider
     */
    public function withProvider(Provider|string $provider): self
    {
        $self = clone $this;
        $self['provider'] = $provider;

        return $self;
    }
}
