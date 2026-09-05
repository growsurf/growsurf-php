<?php

declare(strict_types=1);

namespace Growsurf\ServiceContracts\Campaign;

use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 * @phpstan-import-type CampaignEmailsShape from \Growsurf\Campaign\CampaignEmails
 * @phpstan-import-type CampaignEmailsUpdateShape from \Growsurf\Campaign\CampaignEmails
 */
interface EmailsContract
{
    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @return CampaignEmailsShape
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): array;

    /**
     * @api
     *
     * @param string $id growSurf program ID
     * @param CampaignEmailsUpdateShape $body partial `CampaignEmails` (see API reference)
     * @param RequestOpts|null $requestOptions
     *
     * @return CampaignEmailsShape
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array $body = [],
        RequestOptions|array|null $requestOptions = null,
    ): array;
}
