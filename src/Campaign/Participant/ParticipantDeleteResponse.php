<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type PendingAnalyticsErasureShape from \Growsurf\Campaign\Participant\PendingAnalyticsErasure
 *
 * @phpstan-type ParticipantDeleteResponseShape = array{success: bool, analyticsErasure?: PendingAnalyticsErasure|PendingAnalyticsErasureShape|null}
 */
final class ParticipantDeleteResponse implements BaseModel
{
    /** @use SdkModel<ParticipantDeleteResponseShape> */
    use SdkModel;

    #[Required]
    public bool $success;

    /** Analytics erasure is pending. Do not repeat successful deletions. */
    #[Optional]
    public ?PendingAnalyticsErasure $analyticsErasure;

    /**
     * `new ParticipantDeleteResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantDeleteResponse::with(success: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantDeleteResponse)->withSuccess(...)
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
     * @param PendingAnalyticsErasure|PendingAnalyticsErasureShape|null $analyticsErasure
     */
    public static function with(bool $success, PendingAnalyticsErasure|array|null $analyticsErasure = null): self
    {
        $self = new self;

        $self['success'] = $success;

        null !== $analyticsErasure && $self['analyticsErasure'] = $analyticsErasure;

        return $self;
    }

    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }

    /** @param PendingAnalyticsErasure|PendingAnalyticsErasureShape|null $analyticsErasure */
    public function withAnalyticsErasure(PendingAnalyticsErasure|array|null $analyticsErasure): self
    {
        $self = clone $this;
        $self['analyticsErasure'] = $analyticsErasure;

        return $self;
    }
}
