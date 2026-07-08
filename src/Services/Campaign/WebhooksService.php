<?php

declare(strict_types=1);

namespace Growsurf\Services\Campaign;

use Growsurf\Campaign\DeleteWebhookResponse;
use Growsurf\Campaign\Webhook;
use Growsurf\Campaign\WebhookEvent;
use Growsurf\Campaign\WebhookListResponse;
use Growsurf\Campaign\WebhookTestResponse;
use Growsurf\Client;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\Core\Util;
use Growsurf\RequestOptions;
use Growsurf\ServiceContracts\Campaign\WebhooksContract;

/**
 * Program webhooks.
 *
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
final class WebhooksService implements WebhooksContract
{
    /**
     * @api
     */
    public WebhooksRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new WebhooksRawService($client);
    }

    /**
     * @api
     *
     * Lists a program's webhooks (secrets are never returned).
     *
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): WebhookListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Adds a webhook to the program.
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
    ): Webhook {
        $params = Util::removeNulls(
            [
                'payloadURL' => $payloadURL,
                'events' => $events,
                'isEnabled' => $isEnabled,
                'secret' => $secret,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Updates a webhook by id.
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
    ): Webhook {
        $params = Util::removeNulls(
            [
                'id' => $id,
                'events' => $events,
                'isEnabled' => $isEnabled,
                'payloadURL' => $payloadURL,
                'secret' => $secret,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($webhookID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Removes a webhook by id.
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
    ): DeleteWebhookResponse {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($webhookID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Sends a live test event to a webhook using its stored URL and secret.
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
    ): WebhookTestResponse {
        $params = Util::removeNulls(['id' => $id, 'event' => $event]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->test($webhookID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
