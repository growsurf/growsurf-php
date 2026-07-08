<?php

declare(strict_types=1);

namespace Growsurf\Campaign\ReferralFlowScreenshotsResponse;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type ReferralFlowScreenshotShape = array{
 *   view: 'referrer'|'referredFriend',
 *   url: string,
 *   width: int,
 *   height: int,
 * }
 */
final class ReferralFlowScreenshot implements BaseModel
{
    /** @use SdkModel<ReferralFlowScreenshotShape> */
    use SdkModel;

    /**
     * The referral-flow view captured in this screenshot.
     *
     * @var 'referrer'|'referredFriend' $view
     */
    #[Required]
    public string $view;

    /**
     * Image URL for the generated screenshot.
     */
    #[Required]
    public string $url;

    /**
     * Screenshot viewport width in CSS pixels.
     */
    #[Required]
    public int $width;

    /**
     * Screenshot viewport height in CSS pixels.
     */
    #[Required]
    public int $height;

    /**
     * `new ReferralFlowScreenshot()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ReferralFlowScreenshot::with(view: ..., url: ..., width: ..., height: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ReferralFlowScreenshot)
     *   ->withView(...)
     *   ->withUrl(...)
     *   ->withWidth(...)
     *   ->withHeight(...)
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
     * @param 'referrer'|'referredFriend' $view
     */
    public static function with(string $view, string $url, int $width, int $height): self
    {
        $self = new self;

        $self['view'] = $view;
        $self['url'] = $url;
        $self['width'] = $width;
        $self['height'] = $height;

        return $self;
    }

    /**
     * The referral-flow view captured in this screenshot.
     *
     * @param 'referrer'|'referredFriend' $view
     */
    public function withView(string $view): self
    {
        $self = clone $this;
        $self['view'] = $view;

        return $self;
    }

    /**
     * Image URL for the generated screenshot.
     */
    public function withUrl(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Screenshot viewport width in CSS pixels.
     */
    public function withWidth(int $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }

    /**
     * Screenshot viewport height in CSS pixels.
     */
    public function withHeight(int $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }
}
