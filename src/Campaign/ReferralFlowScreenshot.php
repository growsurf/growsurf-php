<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Campaign\ReferralFlowScreenshot\View;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type ReferralFlowScreenshotShape = array{
 *   contentType?: string|null,
 *   expiresAt?: string|null,
 *   height?: int|null,
 *   label?: string|null,
 *   url?: string|null,
 *   view?: null|View|value-of<View>,
 *   width?: int|null,
 * }
 */
final class ReferralFlowScreenshot implements BaseModel
{
    /** @use SdkModel<ReferralFlowScreenshotShape> */
    use SdkModel;

    /**
     * MIME type of the image.
     */
    #[Optional]
    public ?string $contentType;

    /**
     * ISO 8601 time after which `url` no longer resolves.
     */
    #[Optional]
    public ?string $expiresAt;

    /**
     * Image height in pixels.
     */
    #[Optional]
    public ?int $height;

    /**
     * Short human-readable name for the view, such as `Referrer window`.
     */
    #[Optional]
    public ?string $label;

    /**
     * Private URL of the image. It stops working at `expiresAt`.
     */
    #[Optional]
    public ?string $url;

    /**
     * Which side of the referral flow the image shows.
     *
     * @var value-of<View>|null $view
     */
    #[Optional(enum: View::class)]
    public ?string $view;

    /**
     * Image width in pixels.
     */
    #[Optional]
    public ?int $width;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param View|value-of<View>|null $view
     */
    public static function with(
        ?string $contentType = null,
        ?string $expiresAt = null,
        ?int $height = null,
        ?string $label = null,
        ?string $url = null,
        View|string|null $view = null,
        ?int $width = null,
    ): self {
        $self = new self;

        null !== $contentType && $self['contentType'] = $contentType;
        null !== $expiresAt && $self['expiresAt'] = $expiresAt;
        null !== $height && $self['height'] = $height;
        null !== $label && $self['label'] = $label;
        null !== $url && $self['url'] = $url;
        null !== $view && $self['view'] = $view;
        null !== $width && $self['width'] = $width;

        return $self;
    }

    /**
     * MIME type of the image.
     */
    public function withContentType(string $contentType): self
    {
        $self = clone $this;
        $self['contentType'] = $contentType;

        return $self;
    }

    /**
     * ISO 8601 time after which `url` no longer resolves.
     */
    public function withExpiresAt(string $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * Image height in pixels.
     */
    public function withHeight(int $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * Short human-readable name for the view, such as `Referrer window`.
     */
    public function withLabel(string $label): self
    {
        $self = clone $this;
        $self['label'] = $label;

        return $self;
    }

    /**
     * Private URL of the image. It stops working at `expiresAt`.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Which side of the referral flow the image shows.
     *
     * @param View|value-of<View> $view
     */
    public function withView(View|string $view): self
    {
        $self = clone $this;
        $self['view'] = $view;

        return $self;
    }

    /**
     * Image width in pixels.
     */
    public function withWidth(int $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
