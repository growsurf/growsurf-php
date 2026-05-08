<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Sends email invites on behalf of a participant to a list of email addresses.
 *
 * @see Growsurf\Services\Campaign\ParticipantService::sendInvites()
 *
 * @phpstan-type ParticipantSendInvitesParamsShape = array{
 *   id: string,
 *   emailAddresses: list<string>,
 *   messageText: string,
 *   subjectText: string,
 * }
 */
final class ParticipantSendInvitesParams implements BaseModel
{
    /** @use SdkModel<ParticipantSendInvitesParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /** @var list<string> $emailAddresses */
    #[Required(list: 'string')]
    public array $emailAddresses;

    #[Required]
    public string $messageText;

    #[Required]
    public string $subjectText;

    /**
     * `new ParticipantSendInvitesParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantSendInvitesParams::with(
     *   id: ..., emailAddresses: ..., messageText: ..., subjectText: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantSendInvitesParams)
     *   ->withID(...)
     *   ->withEmailAddresses(...)
     *   ->withMessageText(...)
     *   ->withSubjectText(...)
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
     * @param list<string> $emailAddresses
     */
    public static function with(
        string $id,
        array $emailAddresses,
        string $messageText,
        string $subjectText
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['emailAddresses'] = $emailAddresses;
        $self['messageText'] = $messageText;
        $self['subjectText'] = $subjectText;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * @param list<string> $emailAddresses
     */
    public function withEmailAddresses(array $emailAddresses): self
    {
        $self = clone $this;
        $self['emailAddresses'] = $emailAddresses;

        return $self;
    }

    public function withMessageText(string $messageText): self
    {
        $self = clone $this;
        $self['messageText'] = $messageText;

        return $self;
    }

    public function withSubjectText(string $subjectText): self
    {
        $self = clone $this;
        $self['subjectText'] = $subjectText;

        return $self;
    }
}
