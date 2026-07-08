<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Sends a live test event to a webhook using its stored URL and secret.
 *
 * @see Growsurf\Services\Campaign\WebhooksService::test()
 *
 * @phpstan-type WebhookTestParamsShape = array{
 *   id: string, event?: null|WebhookEvent|value-of<WebhookEvent>
 * }
 */
final class WebhookTestParams implements BaseModel
{
    /** @use SdkModel<WebhookTestParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * The event to simulate. When omitted, the webhook's first enabled event is used (returns `400` if the webhook has no enabled events).
     *
     * @var value-of<WebhookEvent>|null $event
     */
    #[Optional(enum: WebhookEvent::class)]
    public ?string $event;

    /**
     * `new WebhookTestParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookTestParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookTestParams)->withID(...)
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
     * @param WebhookEvent|value-of<WebhookEvent>|null $event
     */
    public static function with(
        string $id,
        WebhookEvent|string|null $event = null
    ): self {
        $self = new self;

        $self['id'] = $id;

        null !== $event && $self['event'] = $event;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The event to simulate. When omitted, the webhook's first enabled event is used (returns `400` if the webhook has no enabled events).
     *
     * @param WebhookEvent|value-of<WebhookEvent> $event
     */
    public function withEvent(WebhookEvent|string $event): self
    {
        $self = clone $this;
        $self['event'] = $event;

        return $self;
    }
}
