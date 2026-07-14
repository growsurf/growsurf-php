<?php

declare(strict_types=1);

namespace Growsurf\Services\Campaign;

use Growsurf\Client;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;
use Growsurf\ServiceContracts\Campaign\InstallationContract;

/**
 * Campaign installation (`CampaignInstallation`) configuration — the dashboard Program Editor's **Installation** tab.
 *
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 */
final class InstallationService implements InstallationContract
{
    /**
     * @api
     */
    public InstallationRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new InstallationRawService($client);
    }

    /**
     * @api
     *
     * Retrieves a program's installation configuration — the same surface as the dashboard Program Editor's **Installation** tab (plus the Mobile SDK settings). Includes the referral trigger (referral programs only), signup tracking method, share URL and whitelist, custom-form signup settings, and mobile SDK settings.
     *
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @return array<string,mixed>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): array {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Updates a program's installation configuration. Only the fields you send are changed; omitted fields are left untouched. `referralTrigger` is only available for referral programs. `mobile.publicKey` is read-only; if no key exists yet, enabling `mobile.isEnabled` creates one. Changing `shareUrl` re-resolves its redirect destinations, which may take a moment to complete. URLs must include an explicit `http://` or `https://` scheme.
     *
     * @param string $id growSurf program ID
     * @param array<string,mixed> $body partial `CampaignInstallation` (see API reference)
     * @param RequestOpts|null $requestOptions
     *
     * @return array<string,mixed>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array $body = [],
        RequestOptions|array|null $requestOptions = null,
    ): array {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($id, body: $body, requestOptions: $requestOptions);

        return $response->parse();
    }
}
