<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Adds a webhook to the program.
 *
 * @see Growsurf\Services\Campaign\WebhooksService::create()
 *
 * @phpstan-type WebhookCreateParamsShape = array{
 *   payloadURL: string,
 *   events?: list<WebhookEvent|value-of<WebhookEvent>>|null,
 *   isEnabled?: bool|null,
 *   secret?: string|null,
 * }
 */
final class WebhookCreateParams implements BaseModel
{
    /** @use SdkModel<WebhookCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The URL that receives webhook deliveries.
     */
    #[Required('payloadUrl')]
    public string $payloadURL;

    /**
     * The events this webhook is subscribed to. When omitted, the webhook is subscribed to no events.
     *
     * @var list<value-of<WebhookEvent>>|null $events
     */
    #[Optional(list: WebhookEvent::class)]
    public ?array $events;

    #[Optional]
    public ?bool $isEnabled;

    /**
     * Write-only. Used to sign deliveries (the `GrowSurf-Signature` HMAC header). Never returned.
     */
    #[Optional]
    public ?string $secret;

    /**
     * `new WebhookCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookCreateParams::with(payloadURL: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookCreateParams)->withPayloadURL(...)
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
     * @param list<WebhookEvent|value-of<WebhookEvent>>|null $events
     */
    public static function with(
        string $payloadURL,
        ?array $events = null,
        ?bool $isEnabled = null,
        ?string $secret = null,
    ): self {
        $self = new self;

        $self['payloadURL'] = $payloadURL;

        null !== $events && $self['events'] = $events;
        null !== $isEnabled && $self['isEnabled'] = $isEnabled;
        null !== $secret && $self['secret'] = $secret;

        return $self;
    }

    /**
     * The URL that receives webhook deliveries.
     */
    public function withPayloadURL(string $payloadURL): self
    {
        $self = clone $this;
        $self['payloadURL'] = $payloadURL;

        return $self;
    }

    /**
     * The events this webhook is subscribed to. When omitted, the webhook is subscribed to no events.
     *
     * @param list<WebhookEvent|value-of<WebhookEvent>> $events
     */
    public function withEvents(array $events): self
    {
        $self = clone $this;
        $self['events'] = $events;

        return $self;
    }

    public function withIsEnabled(bool $isEnabled): self
    {
        $self = clone $this;
        $self['isEnabled'] = $isEnabled;

        return $self;
    }

    /**
     * Write-only. Used to sign deliveries (the `GrowSurf-Signature` HMAC header). Never returned.
     */
    public function withSecret(string $secret): self
    {
        $self = clone $this;
        $self['secret'] = $secret;

        return $self;
    }
}
