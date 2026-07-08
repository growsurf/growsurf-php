<?php

declare(strict_types=1);

namespace Growsurf\ServiceContracts\Campaign;

use Growsurf\Campaign\DeleteWebhookResponse;
use Growsurf\Campaign\Webhook;
use Growsurf\Campaign\WebhookEvent;
use Growsurf\Campaign\WebhookListResponse;
use Growsurf\Campaign\WebhookTestResponse;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
interface WebhooksContract
{
    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): WebhookListResponse;

    /**
     * @api
     *
     * @param string $id path param: GrowSurf program ID
     * @param string $payloadURL body param: The URL that receives webhook deliveries
     * @param list<WebhookEvent|value-of<WebhookEvent>> $events body param: The events this webhook is subscribed to. When omitted, the webhook is subscribed to no events.
     * @param bool $isEnabled Body param
     * @param string $secret body param: Write-only. Used to sign deliveries (the `GrowSurf-Signature` HMAC header). Never returned.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $id,
        string $payloadURL,
        ?array $events = null,
        ?bool $isEnabled = null,
        ?string $secret = null,
        RequestOptions|array|null $requestOptions = null,
    ): Webhook;

    /**
     * @api
     *
     * @param string $webhookID path param: The webhook id
     * @param string $id path param: GrowSurf program ID
     * @param list<WebhookEvent|value-of<WebhookEvent>> $events Body param
     * @param bool $isEnabled Body param
     * @param string $payloadURL Body param
     * @param string $secret body param: Write-only
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $webhookID,
        string $id,
        ?array $events = null,
        ?bool $isEnabled = null,
        ?string $payloadURL = null,
        ?string $secret = null,
        RequestOptions|array|null $requestOptions = null,
    ): Webhook;

    /**
     * @api
     *
     * @param string $webhookID path param: The webhook id
     * @param string $id path param: GrowSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $webhookID,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): DeleteWebhookResponse;

    /**
     * @api
     *
     * @param string $webhookID path param: The webhook id
     * @param string $id path param: GrowSurf program ID
     * @param WebhookEvent|value-of<WebhookEvent> $event body param: The event to simulate. When omitted, the webhook's first enabled event is used (returns `400` if the webhook has no enabled events).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function test(
        string $webhookID,
        string $id,
        WebhookEvent|string|null $event = null,
        RequestOptions|array|null $requestOptions = null,
    ): WebhookTestResponse;
}
