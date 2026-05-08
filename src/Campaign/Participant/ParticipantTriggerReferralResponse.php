<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type ParticipantTriggerReferralResponseShape = array{
 *   success: bool, message?: string|null
 * }
 */
final class ParticipantTriggerReferralResponse implements BaseModel
{
    /** @use SdkModel<ParticipantTriggerReferralResponseShape> */
    use SdkModel;

    #[Required]
    public bool $success;

    #[Optional]
    public ?string $message;

    /**
     * `new ParticipantTriggerReferralResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantTriggerReferralResponse::with(success: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantTriggerReferralResponse)->withSuccess(...)
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
    public static function with(bool $success, ?string $message = null): self
    {
        $self = new self;

        $self['success'] = $success;

        null !== $message && $self['message'] = $message;

        return $self;
    }

    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }

    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }
}
