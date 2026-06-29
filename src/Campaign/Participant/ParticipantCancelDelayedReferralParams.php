<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Cancels a pending delayed referral trigger for a participant by GrowSurf participant ID or email address.
 *
 * @see Growsurf\Services\Campaign\ParticipantService::cancelDelayedReferral()
 *
 * @phpstan-type ParticipantCancelDelayedReferralParamsShape = array{id: string}
 */
final class ParticipantCancelDelayedReferralParams implements BaseModel
{
    /** @use SdkModel<ParticipantCancelDelayedReferralParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * `new ParticipantCancelDelayedReferralParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantCancelDelayedReferralParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantCancelDelayedReferralParams)->withID(...)
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
