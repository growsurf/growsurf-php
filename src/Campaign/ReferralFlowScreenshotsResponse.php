<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Campaign\ReferralFlowScreenshotsResponse\ReferralFlowScreenshot;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ReferralFlowScreenshotShape from \Growsurf\Campaign\ReferralFlowScreenshotsResponse\ReferralFlowScreenshot
 *
 * @phpstan-type ReferralFlowScreenshotsResponseShape = array{
 *   referrer: ReferralFlowScreenshot|ReferralFlowScreenshotShape,
 *   referredFriend: ReferralFlowScreenshot|ReferralFlowScreenshotShape,
 *   generatedAt: int,
 * }
 */
final class ReferralFlowScreenshotsResponse implements BaseModel
{
    /** @use SdkModel<ReferralFlowScreenshotsResponseShape> */
    use SdkModel;

    /**
     * Screenshot of the referral flow as a signed-in referrer sees it.
     */
    #[Required]
    public ReferralFlowScreenshot $referrer;

    /**
     * Screenshot of the referral flow as the referred friend sees it.
     */
    #[Required]
    public ReferralFlowScreenshot $referredFriend;

    /**
     * When the screenshots were generated, as a Unix timestamp in milliseconds.
     */
    #[Required]
    public int $generatedAt;

    /**
     * `new ReferralFlowScreenshotsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ReferralFlowScreenshotsResponse::with(
     *   referrer: ..., referredFriend: ..., generatedAt: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ReferralFlowScreenshotsResponse)
     *   ->withReferrer(...)
     *   ->withReferredFriend(...)
     *   ->withGeneratedAt(...)
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
     * @param ReferralFlowScreenshot|ReferralFlowScreenshotShape $referrer
     * @param ReferralFlowScreenshot|ReferralFlowScreenshotShape $referredFriend
     */
    public static function with(
        ReferralFlowScreenshot|array $referrer,
        ReferralFlowScreenshot|array $referredFriend,
        int $generatedAt,
    ): self {
        $self = new self;

        $self['referrer'] = $referrer;
        $self['referredFriend'] = $referredFriend;
        $self['generatedAt'] = $generatedAt;

        return $self;
    }

    /**
     * Screenshot of the referral flow as a signed-in referrer sees it.
     *
     * @param ReferralFlowScreenshot|ReferralFlowScreenshotShape $referrer
     */
    public function withReferrer(ReferralFlowScreenshot|array $referrer): self
    {
        $self = clone $this;
        $self['referrer'] = $referrer;

        return $self;
    }

    /**
     * Screenshot of the referral flow as the referred friend sees it.
     *
     * @param ReferralFlowScreenshot|ReferralFlowScreenshotShape $referredFriend
     */
    public function withReferredFriend(ReferralFlowScreenshot|array $referredFriend): self
    {
        $self = clone $this;
        $self['referredFriend'] = $referredFriend;

        return $self;
    }

    /**
     * When the screenshots were generated, as a Unix timestamp in milliseconds.
     */
    public function withGeneratedAt(int $generatedAt): self
    {
        $self = clone $this;
        $self['generatedAt'] = $generatedAt;

        return $self;
    }
}
