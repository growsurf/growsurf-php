<?php

declare(strict_types=1);

namespace Growsurf\Services\Campaign;

use Growsurf\Campaign\CampaignCustomDomain;
use Growsurf\Campaign\CustomDomainSetParams;
use Growsurf\Campaign\DeleteCampaignCustomDomainResponse;
use Growsurf\Client;
use Growsurf\Core\Contracts\BaseResponse;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;
use Growsurf\ServiceContracts\Campaign\CustomDomainRawContract;

/**
 * The custom domain that serves a program's landing pages.
 *
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
final class CustomDomainRawService implements CustomDomainRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieves the custom domain that serves a program's landing pages, and whether its DNS is verified. When no custom domain is set, `domain` is `null`. This call does not check DNS; use `POST /campaign/{id}/custom-domain/verify` for a live check.
     *
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CampaignCustomDomain>
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
            path: ['campaign/%1$s/custom-domain', $id],
            options: $requestOptions,
            convert: CampaignCustomDomain::class,
        );
    }

    /**
     * @api
     *
     * Sets the custom domain for a program's landing pages, or replaces the current one. Send a hostname such as `refer.piedpiper.com`; `https://` is added if you leave it out. Paths, ports, queries and `http://` return a `400`.
     * Replacing a domain removes the old one right away, and its pages stop loading there. Sending the current domain again changes nothing. A domain used by another program returns a `409`.
     * A new domain starts unverified. Point a `CNAME` record from the hostname to the `dnsRecord.value` in the response, then call `POST /campaign/{id}/custom-domain/verify`.
     *
     * @param string $id growSurf program ID
     * @param array{domain: string}|CustomDomainSetParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CampaignCustomDomain>
     *
     * @throws APIException
     */
    public function set(
        string $id,
        array|CustomDomainSetParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CustomDomainSetParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['campaign/%1$s/custom-domain', $id],
            body: (object) $parsed,
            options: $options,
            convert: CampaignCustomDomain::class,
        );
    }

    /**
     * @api
     *
     * Checks the custom domain's DNS now and returns the result in `isVerified`. The first time the check passes, GrowSurf sets up the domain's SSL certificate; pages can take a few minutes to load over `https://` after that. If the record is wrong or has not propagated yet, `isVerified` stays `false`; call again later. More than one `CNAME` record on the hostname returns a `400`. Returns a `404` when no custom domain is set.
     * A domain that is already verified is returned as is, without a new check.
     *
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CampaignCustomDomain>
     *
     * @throws APIException
     */
    public function verify(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['campaign/%1$s/custom-domain/verify', $id],
            options: $requestOptions,
            convert: CampaignCustomDomain::class,
        );
    }

    /**
     * @api
     *
     * Removes a program's custom domain. Its landing pages go back to their GrowSurf URL. Returns a `404` when no custom domain is set.
     *
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeleteCampaignCustomDomainResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['campaign/%1$s/custom-domain', $id],
            options: $requestOptions,
            convert: DeleteCampaignCustomDomainResponse::class,
        );
    }
}
