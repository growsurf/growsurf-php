<?php

declare(strict_types=1);

namespace Growsurf\Services;

use Growsurf\Account\AccountCreateParams;
use Growsurf\Account\CreateAccountResponse;
use Growsurf\Client;
use Growsurf\Core\Contracts\BaseResponse;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;
use Growsurf\ServiceContracts\AccountRawContract;

/**
 * Create a GrowSurf account and its initial API key.
 *
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
final class AccountRawService implements AccountRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Creates a new GrowSurf account and returns an API key shown once in the response.
     *
     * @param array{
     *   email: string,
     *   company?: string,
     *   firstName?: string,
     *   lastName?: string,
     * }|AccountCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CreateAccountResponse>
     *
     * @throws APIException
     */
    public function create(
        array|AccountCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AccountCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'accounts',
            headers: ['Authorization' => null],
            body: (object) $parsed,
            options: $options,
            convert: CreateAccountResponse::class,
        );
    }
}
