<?php

declare(strict_types=1);

namespace Growsurf\ServiceContracts\Campaign;

use Growsurf\Campaign\DeleteWebhookResponse;
use Growsurf\Campaign\Webhook;
use Growsurf\Campaign\WebhookCreateParams;
use Growsurf\Campaign\WebhookDeleteParams;
use Growsurf\Campaign\WebhookListResponse;
use Growsurf\Campaign\WebhookTestParams;
use Growsurf\Campaign\WebhookTestResponse;
use Growsurf\Campaign\WebhookUpdateParams;
use Growsurf\Core\Contracts\BaseResponse;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
interface WebhooksRawContract
{
    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param array<string,mixed>|WebhookCreateParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $webhookID path param: The webhook id
     * @param array<string,mixed>|WebhookUpdateParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $webhookID path param: The webhook id
     * @param array<string,mixed>|WebhookDeleteParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $webhookID path param: The webhook id
     * @param array<string,mixed>|WebhookTestParams $params
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
    ): BaseResponse;
}
