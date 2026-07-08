<?php

declare(strict_types=1);

namespace Growsurf\Services\Campaign;

use Growsurf\Campaign\DeleteWebhookResponse;
use Growsurf\Campaign\Webhook;
use Growsurf\Campaign\WebhookCreateParams;
use Growsurf\Campaign\WebhookDeleteParams;
use Growsurf\Campaign\WebhookEvent;
use Growsurf\Campaign\WebhookListResponse;
use Growsurf\Campaign\WebhookTestParams;
use Growsurf\Campaign\WebhookTestResponse;
use Growsurf\Campaign\WebhookUpdateParams;
use Growsurf\Client;
use Growsurf\Core\Contracts\BaseResponse;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;
use Growsurf\ServiceContracts\Campaign\WebhooksRawContract;

/**
 * Program webhooks.
 *
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
final class WebhooksRawService implements WebhooksRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Lists a program's webhooks (secrets are never returned).
     *
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebhookListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['campaign/%1$s/webhooks', $id],
            options: $requestOptions,
            convert: WebhookListResponse::class,
        );
    }

    /**
     * @api
     *
     * Adds a webhook to the program.
     *
     * @param string $id growSurf program ID
     * @param array{
     *   payloadURL: string,
     *   events?: list<WebhookEvent|value-of<WebhookEvent>>,
     *   isEnabled?: bool,
     *   secret?: string,
     * }|WebhookCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Webhook>
     *
     * @throws APIException
     */
    public function create(
        string $id,
        array|WebhookCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WebhookCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['campaign/%1$s/webhooks', $id],
            body: (object) $parsed,
            options: $options,
            convert: Webhook::class,
        );
    }

    /**
     * @api
     *
     * Updates a webhook by id.
     *
     * @param string $webhookID path param: The webhook id
     * @param array{
     *   id: string,
     *   events?: list<WebhookEvent|value-of<WebhookEvent>>,
     *   isEnabled?: bool,
     *   payloadURL?: string,
     *   secret?: string,
     * }|WebhookUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Webhook>
     *
     * @throws APIException
     */
    public function update(
        string $webhookID,
        array|WebhookUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WebhookUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['campaign/%1$s/webhooks/%2$s', $id, $webhookID],
            body: (object) array_diff_key($parsed, array_flip(['id'])),
            options: $options,
            convert: Webhook::class,
        );
    }

    /**
     * @api
     *
     * Removes a webhook by id.
     *
     * @param string $webhookID path param: The webhook id
     * @param array{id: string}|WebhookDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeleteWebhookResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $webhookID,
        array|WebhookDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WebhookDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['campaign/%1$s/webhooks/%2$s', $id, $webhookID],
            options: $options,
            convert: DeleteWebhookResponse::class,
        );
    }

    /**
     * @api
     *
     * Sends a live test event to a webhook using its stored URL and secret.
     *
     * @param string $webhookID path param: The webhook id
     * @param array{
     *   id: string, event?: WebhookEvent|value-of<WebhookEvent>
     * }|WebhookTestParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebhookTestResponse>
     *
     * @throws APIException
     */
    public function test(
        string $webhookID,
        array|WebhookTestParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WebhookTestParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['campaign/%1$s/webhooks/%2$s/test', $id, $webhookID],
            body: (object) array_diff_key($parsed, array_flip(['id'])),
            options: $options,
            convert: WebhookTestResponse::class,
        );
    }
}
