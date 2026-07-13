<?php

declare(strict_types=1);

namespace Growsurf\Team;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * The team bound to the API key or OAuth connection.
 *
 * @phpstan-type TeamShape = array{
 *   name: string,
 *   verificationStatus: VerificationStatus|value-of<VerificationStatus>,
 *   verificationRequestedAt: int|null,
 * }
 */
final class Team implements BaseModel
{
    /** @use SdkModel<TeamShape> */
    use SdkModel;

    /**
     * The team's display name.
     */
    #[Required]
    public string $name;

    /**
     * GrowSurf team verification state. `VERIFIED` is required before a program can send participant emails.
     *
     * @var value-of<VerificationStatus> $verificationStatus
     */
    #[Required(enum: VerificationStatus::class)]
    public string $verificationStatus;

    /**
     * When team verification was last requested, as a Unix timestamp in milliseconds.
     */
    #[Required]
    public ?int $verificationRequestedAt;

    /**
     * `new Team()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Team::with(
     *   name: ...,
     *   verificationStatus: ...,
     *   verificationRequestedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Team)
     *   ->withName(...)
     *   ->withVerificationStatus(...)
     *   ->withVerificationRequestedAt(...)
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
     * @param VerificationStatus|value-of<VerificationStatus> $verificationStatus
     */
    public static function with(
        string $name,
        VerificationStatus|string $verificationStatus,
        ?int $verificationRequestedAt,
    ): self {
        $self = new self;

        $self['name'] = $name;
        $self['verificationStatus'] = $verificationStatus;
        $self['verificationRequestedAt'] = $verificationRequestedAt;

        return $self;
    }

    /**
     * The team's display name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * GrowSurf team verification state. `VERIFIED` is required before a program can send participant emails.
     *
     * @param VerificationStatus|value-of<VerificationStatus> $verificationStatus
     */
    public function withVerificationStatus(
        VerificationStatus|string $verificationStatus,
    ): self {
        $self = clone $this;
        $self['verificationStatus'] = $verificationStatus;

        return $self;
    }

    /**
     * When team verification was last requested, as a Unix timestamp in milliseconds.
     */
    public function withVerificationRequestedAt(
        ?int $verificationRequestedAt
    ): self {
        $self = clone $this;
        $self['verificationRequestedAt'] = $verificationRequestedAt;

        return $self;
    }
}
