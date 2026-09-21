<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ReferralFlowScreenshotShape from \Growsurf\Campaign\ReferralFlowScreenshot
 *
 * @phpstan-type ReferralFlowScreenshotsResponseShape = array{
 *   expiresAt?: string|null,
 *   generatedAt?: string|null,
 *   screenshots?: list<ReferralFlowScreenshot|ReferralFlowScreenshotShape>|null,
 * }
 */
final class ReferralFlowScreenshotsResponse implements BaseModel
{
    /** @use SdkModel<ReferralFlowScreenshotsResponseShape> */
    use SdkModel;

    /**
     * ISO 8601 time after which every `url` in `screenshots` stops working.
     */
    #[Optional]
    public ?string $expiresAt;

    /**
     * ISO 8601 time the images were rendered.
     */
    #[Optional]
    public ?string $generatedAt;

    /**
     * One entry per view, in referrer then referred-friend order.
     *
     * @var list<ReferralFlowScreenshot>|null $screenshots
     */
    #[Optional(list: ReferralFlowScreenshot::class)]
    public ?array $screenshots;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<ReferralFlowScreenshot|ReferralFlowScreenshotShape>|null $screenshots
     */
    public static function with(
        ?string $expiresAt = null,
        ?string $generatedAt = null,
        ?array $screenshots = null,
    ): self {
        $self = new self;

        null !== $expiresAt && $self['expiresAt'] = $expiresAt;
        null !== $generatedAt && $self['generatedAt'] = $generatedAt;
        null !== $screenshots && $self['screenshots'] = $screenshots;

        return $self;
    }

    /**
     * ISO 8601 time after which every `url` in `screenshots` stops working.
     */
    public function withExpiresAt(string $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * ISO 8601 time the images were rendered.
     */
    public function withGeneratedAt(string $generatedAt): self
    {
        $self = clone $this;
        $self['generatedAt'] = $generatedAt;

        return $self;
    }

    /**
     * One entry per view, in referrer then referred-friend order.
     *
     * @param list<ReferralFlowScreenshot|ReferralFlowScreenshotShape> $screenshots
     */
    public function withScreenshots(array $screenshots): self
    {
        $self = clone $this;
        $self['screenshots'] = $screenshots;

        return $self;
    }
}
