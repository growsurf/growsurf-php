<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * A single participant activity log entry.
 *
 * @phpstan-type ParticipantActivityLogShape = array{
 *   createdAt: int,
 *   text: string,
 *   type: string,
 * }
 */
final class ParticipantActivityLog implements BaseModel
{
    /** @use SdkModel<ParticipantActivityLogShape> */
    use SdkModel;

    /**
     * When the activity occurred, as a Unix timestamp in milliseconds.
     */
    #[Required]
    public int $createdAt;

    #[Required]
    public string $text;

    /**
     * The activity family (e.g. `REFERRAL`, `SHARE`, `REWARD`, `EMAIL`, `COMMON`).
     */
    #[Required]
    public string $type;

    /**
     * `new ParticipantActivityLog()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantActivityLog::with(
     *   createdAt: ...,
     *   text: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantActivityLog)
     *   ->withCreatedAt(...)
     *   ->withText(...)
     *   ->withType(...)
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
        int $createdAt,
        string $text,
        string $type,
    ): self {
        $self = new self;

        $self['createdAt'] = $createdAt;
        $self['text'] = $text;
        $self['type'] = $type;

        return $self;
    }

    /**
     * When the activity occurred, as a Unix timestamp in milliseconds.
     */
    public function withCreatedAt(int $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }

    /**
     * The activity family (e.g. `REFERRAL`, `SHARE`, `REWARD`, `EMAIL`, `COMMON`).
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
