<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Triggers referral credit for an existing referred participant by GrowSurf participant ID or email address.
 *
 * @see Growsurf\Services\Campaign\ParticipantService::triggerReferral()
 *
 * @phpstan-type ParticipantTriggerReferralParamsShape = array{id: string}
 */
final class ParticipantTriggerReferralParams implements BaseModel
{
    /** @use SdkModel<ParticipantTriggerReferralParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * `new ParticipantTriggerReferralParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantTriggerReferralParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantTriggerReferralParams)->withID(...)
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
