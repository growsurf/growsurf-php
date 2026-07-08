<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Updates a webhook by id.
 *
 * @see Growsurf\Services\Campaign\WebhooksService::update()
 *
 * @phpstan-type WebhookUpdateParamsShape = array{
 *   id: string,
 *   events?: list<WebhookEvent|value-of<WebhookEvent>>|null,
 *   isEnabled?: bool|null,
 *   payloadURL?: string|null,
 *   secret?: string|null,
 * }
 */
final class WebhookUpdateParams implements BaseModel
{
    /** @use SdkModel<WebhookUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /** @var list<value-of<WebhookEvent>>|null $events */
    #[Optional(list: WebhookEvent::class)]
    public ?array $events;

    #[Optional]
    public ?bool $isEnabled;

    #[Optional('payloadUrl')]
    public ?string $payloadURL;

    /**
     * Write-only.
     */
    #[Optional]
    public ?string $secret;

    /**
     * `new WebhookUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookUpdateParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookUpdateParams)->withID(...)
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
        string $id,
        ?array $events = null,
        ?bool $isEnabled = null,
        ?string $payloadURL = null,
        ?string $secret = null,
    ): self {
        $self = new self;

        $self['id'] = $id;

        null !== $events && $self['events'] = $events;
        null !== $isEnabled && $self['isEnabled'] = $isEnabled;
        null !== $payloadURL && $self['payloadURL'] = $payloadURL;
        null !== $secret && $self['secret'] = $secret;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
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

    public function withPayloadURL(string $payloadURL): self
    {
        $self = clone $this;
        $self['payloadURL'] = $payloadURL;

        return $self;
    }

    /**
     * Write-only.
     */
    public function withSecret(string $secret): self
    {
        $self = clone $this;
        $self['secret'] = $secret;

        return $self;
    }
}
