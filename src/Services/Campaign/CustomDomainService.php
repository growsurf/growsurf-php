<?php

declare(strict_types=1);

namespace Growsurf\Services\Campaign;

use Growsurf\Campaign\CampaignCustomDomain;
use Growsurf\Campaign\DeleteCampaignCustomDomainResponse;
use Growsurf\Client;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;
use Growsurf\ServiceContracts\Campaign\CustomDomainContract;

/**
 * The custom domain that serves a program's landing pages.
 *
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
final class CustomDomainService implements CustomDomainContract
{
    /**
     * @api
     */
    public CustomDomainRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CustomDomainRawService($client);
    }

    /**
     * @api
     *
     * Retrieves the custom domain that serves a program's landing pages, and whether its DNS is verified. When no custom domain is set, `domain` is `null`. This call does not check DNS; use `POST /campaign/{id}/custom-domain/verify` for a live check.
     *
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): CampaignCustomDomain {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Sets the custom domain for a program's landing pages, or replaces the current one. Send a hostname such as `refer.piedpiper.com`; `https://` is added if you leave it out. Paths, ports, queries and `http://` return a `400`.
     * Replacing a domain removes the old one right away, and its pages stop loading there. Sending the current domain again changes nothing. A domain used by another program returns a `409`.
     * A new domain starts unverified. Point a `CNAME` record from the hostname to the `dnsRecord.value` in the response, then call `POST /campaign/{id}/custom-domain/verify`.
     *
     * @param string $id path param: GrowSurf program ID
     * @param string $domain body param: The hostname to serve the program's landing pages from, with or without `https://`. Up to 255 characters.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function set(
        string $id,
        string $domain,
        RequestOptions|array|null $requestOptions = null,
    ): CampaignCustomDomain {
        $params = ['domain' => $domain];

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->set($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
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
     * @throws APIException
     */
    public function verify(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): CampaignCustomDomain {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->verify($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Removes a program's custom domain. Its landing pages go back to their GrowSurf URL. Returns a `404` when no custom domain is set.
     *
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): DeleteCampaignCustomDomainResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($id, requestOptions: $requestOptions);

        return $response->parse();
    }
}
