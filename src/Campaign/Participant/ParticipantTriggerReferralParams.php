<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Triggers referral credit for an existing referred participant by GrowSurf participant ID or email address.
 *
 * @see Growsurf\Services\Campaign\ParticipantService::triggerReferral()
 *
 * @phpstan-type ParticipantTriggerReferralParamsShape = array{
 *   id: string, delayInDays?: int|null
 * }
 */
final class ParticipantTriggerReferralParams implements BaseModel
{
    /** @use SdkModel<ParticipantTriggerReferralParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * Number of whole days to hold referral credit before it is awarded. Useful for honoring a refund window before crediting a referrer. Omit this field to award credit immediately. The credit is awarded automatically once the delay elapses, and can be cancelled before then with the Cancel delayed referral trigger request.
     */
    #[Optional]
    public ?int $delayInDays;

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
    public static function with(string $id, ?int $delayInDays = null): self
    {
        $self = new self;

        $self['id'] = $id;

        null !== $delayInDays && $self['delayInDays'] = $delayInDays;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Number of whole days to hold referral credit before it is awarded. Useful for honoring a refund window before crediting a referrer. Omit this field to award credit immediately. The credit is awarded automatically once the delay elapses, and can be cancelled before then with the Cancel delayed referral trigger request.
     */
    public function withDelayInDays(int $delayInDays): self
    {
        $self = clone $this;
        $self['delayInDays'] = $delayInDays;

        return $self;
    }
}
