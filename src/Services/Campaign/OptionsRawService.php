<?php

declare(strict_types=1);

namespace Growsurf\Services\Campaign;

use Growsurf\Client;
use Growsurf\Core\Contracts\BaseResponse;
use Growsurf\Core\Conversion\MapOf;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;
use Growsurf\ServiceContracts\Campaign\OptionsRawContract;

/**
 * Campaign options (`CampaignOptions`) configuration — the dashboard Program Editor's **Options** tab.
 *
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
final class OptionsRawService implements OptionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieves a program's options — the same surface as the dashboard Program Editor's **Options** tab (reward/fraud approval, anti-fraud lists, referral windows, reCAPTCHA, payout/tax settings, and notification emails). Secret values such as the reCAPTCHA secret key are never returned. The response includes every field and its current value, which is the same shape you send back on `PATCH`.
     *
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<array<string,mixed>>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['campaign/%1$s/options', $id],
            options: $requestOptions,
            convert: new MapOf('mixed'),
        );
    }

    /**
     * @api
     *
     * Updates a program's options. Only the fields you send are changed. Some fields are program-type specific and some are write-only. To see the full object with every field and its current value, `GET` this resource, then `PATCH` back only the fields you want to change.
     *
     * @param string $id growSurf program ID
     * @param array<string,mixed> $body partial `CampaignOptions` (see API reference)
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<array<string,mixed>>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array $body = [],
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['campaign/%1$s/options', $id],
            body: (object) $body,
            options: $requestOptions,
            convert: new MapOf('mixed'),
        );
    }
}
