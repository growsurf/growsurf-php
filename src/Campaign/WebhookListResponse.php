<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type WebhookShape from \Growsurf\Campaign\Webhook
 *
 * @phpstan-type WebhookListResponseShape = array{
 *   webhooks: list<Webhook|WebhookShape>
 * }
 */
final class WebhookListResponse implements BaseModel
{
    /** @use SdkModel<WebhookListResponseShape> */
    use SdkModel;

    /** @var list<Webhook> $webhooks */
    #[Required(list: Webhook::class)]
    public array $webhooks;

    /**
     * `new WebhookListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookListResponse::with(webhooks: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookListResponse)->withWebhooks(...)
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
     * @param list<Webhook|WebhookShape> $webhooks
     */
    public static function with(array $webhooks): self
    {
        $self = new self;

        $self['webhooks'] = $webhooks;

        return $self;
    }

    /**
     * @param list<Webhook|WebhookShape> $webhooks
     */
    public function withWebhooks(array $webhooks): self
    {
        $self = clone $this;
        $self['webhooks'] = $webhooks;

        return $self;
    }
}
