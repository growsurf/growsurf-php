<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Campaign\CampaignReviewAffiliateApplicationParams\Status;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Decides a pending application. Set `status` to `APPROVED` to enroll the applicant (this creates the participant, or upgrades an existing participant with the same email), or to `DENIED` with an optional `rejectionReason`. A denied applicant may reapply after the program's reapplication cooldown; send an earlier `reapplyAllowedAt` (without `status`) to shorten that wait for one applicant. Provide exactly one of `status` or `reapplyAllowedAt`. Denial-only fields are only valid with `status` set to `DENIED`. Approval is idempotent: repeating it returns the same participant.
 *
 * @see Growsurf\Services\CampaignService::reviewAffiliateApplication()
 *
 * @phpstan-type CampaignReviewAffiliateApplicationParamsShape = array{
 *   allowImmediateReapply?: bool,
 *   reapplyAllowedAt?: int,
 *   rejectionReason?: string,
 *   reviewNote?: string,
 *   status?: Status|value-of<Status>,
 * }
 */
final class CampaignReviewAffiliateApplicationParams implements BaseModel
{
    /** @use SdkModel<CampaignReviewAffiliateApplicationParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * When denying, let the applicant reapply right away instead of waiting out the program's reapplication cooldown. Only valid when `status` is `DENIED`.
     */
    #[Optional]
    public ?bool $allowImmediateReapply;

    /**
     * For an already-denied application, move the reapplication window to this earlier time, in Unix milliseconds. Send without `status`.
     */
    #[Optional]
    public ?int $reapplyAllowedAt;

    /**
     * Short reason recorded with a denial. Only valid when `status` is `DENIED`. Maximum 255 characters.
     */
    #[Optional]
    public ?string $rejectionReason;

    /**
     * Private note recorded with a denial. Only valid when `status` is `DENIED`; never shown to the applicant. Maximum 500 characters.
     */
    #[Optional]
    public ?string $reviewNote;

    /**
     * The decision. `APPROVED` enrolls the applicant as an affiliate; `DENIED` closes the application.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        ?bool $allowImmediateReapply = null,
        ?int $reapplyAllowedAt = null,
        ?string $rejectionReason = null,
        ?string $reviewNote = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        null !== $allowImmediateReapply && $self['allowImmediateReapply'] = $allowImmediateReapply;
        null !== $reapplyAllowedAt && $self['reapplyAllowedAt'] = $reapplyAllowedAt;
        null !== $rejectionReason && $self['rejectionReason'] = $rejectionReason;
        null !== $reviewNote && $self['reviewNote'] = $reviewNote;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * When denying, let the applicant reapply right away instead of waiting out the program's reapplication cooldown. Only valid when `status` is `DENIED`.
     */
    public function withAllowImmediateReapply(
        bool $allowImmediateReapply
    ): self {
        $self = clone $this;
        $self['allowImmediateReapply'] = $allowImmediateReapply;

        return $self;
    }

    /**
     * For an already-denied application, move the reapplication window to this earlier time, in Unix milliseconds. Send without `status`.
     */
    public function withReapplyAllowedAt(int $reapplyAllowedAt): self
    {
        $self = clone $this;
        $self['reapplyAllowedAt'] = $reapplyAllowedAt;

        return $self;
    }

    /**
     * Short reason recorded with a denial. Only valid when `status` is `DENIED`. Maximum 255 characters.
     */
    public function withRejectionReason(string $rejectionReason): self
    {
        $self = clone $this;
        $self['rejectionReason'] = $rejectionReason;

        return $self;
    }

    /**
     * Private note recorded with a denial. Only valid when `status` is `DENIED`; never shown to the applicant. Maximum 500 characters.
     */
    public function withReviewNote(string $reviewNote): self
    {
        $self = clone $this;
        $self['reviewNote'] = $reviewNote;

        return $self;
    }

    /**
     * The decision. `APPROVED` enrolls the applicant as an affiliate; `DENIED` closes the application.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
