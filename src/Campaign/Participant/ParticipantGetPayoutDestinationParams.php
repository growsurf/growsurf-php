<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Returns a participant's payout-destination status across every payout provider enabled for the program (PayPal and/or Wise). For each provider it reports the current status, the confirmed claim email, the legal recipient type, and — when a delivery bounced or a recipient was invalidated — the repair reason. `activeProvider` is the provider that currently gets paid, or `null` until the participant confirms one.
 *
 * @see Growsurf\Services\Campaign\ParticipantService::getPayoutDestination()
 *
 * @phpstan-type ParticipantGetPayoutDestinationParamsShape = array{id: string}
 */
final class ParticipantGetPayoutDestinationParams implements BaseModel
{
    /** @use SdkModel<ParticipantGetPayoutDestinationParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * `new ParticipantGetPayoutDestinationParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantGetPayoutDestinationParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantGetPayoutDestinationParams)->withID(...)
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
     */
    public static function with(string $id): self
    {
        $self = new self;

        $self['id'] = $id;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }
}
