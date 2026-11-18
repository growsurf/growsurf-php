<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type ParticipantSendInvitesResponseShape = array{
 *   invitesSent: int, messageType: string, success: bool, message?: string|null
 * }
 */
final class ParticipantSendInvitesResponse implements BaseModel
{
    /** @use SdkModel<ParticipantSendInvitesResponseShape> */
    use SdkModel;

    #[Required]
    public int $invitesSent;

    #[Required]
    public string $messageType;

    #[Required]
    public bool $success;

    /**
     * Human-readable detail for the result. Empty when there is nothing to add.
     */
    #[Optional]
    public ?string $message;

    /**
     * `new ParticipantSendInvitesResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantSendInvitesResponse::with(
     *   invitesSent: ..., messageType: ..., success: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantSendInvitesResponse)
     *   ->withInvitesSent(...)
     *   ->withMessageType(...)
     *   ->withSuccess(...)
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
    public static function with(
        int $invitesSent,
        string $messageType,
        bool $success,
        ?string $message = null,
    ): self {
        $self = new self;

        $self['invitesSent'] = $invitesSent;
        $self['messageType'] = $messageType;
        $self['success'] = $success;

        null !== $message && $self['message'] = $message;

        return $self;
    }

    public function withInvitesSent(int $invitesSent): self
    {
        $self = clone $this;
        $self['invitesSent'] = $invitesSent;

        return $self;
    }

    public function withMessageType(string $messageType): self
    {
        $self = clone $this;
        $self['messageType'] = $messageType;

        return $self;
    }

    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }

    /**
     * Human-readable detail for the result. Empty when there is nothing to add.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }
}
