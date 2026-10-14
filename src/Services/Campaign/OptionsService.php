<?php

declare(strict_types=1);

namespace Growsurf\Services\Campaign;

use Growsurf\Client;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;
use Growsurf\ServiceContracts\Campaign\OptionsContract;

/**
 * Campaign options (`CampaignOptions`) configuration — the dashboard Program Editor's **Options** tab.
 *
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 * @phpstan-import-type CampaignOptionsShape from \Growsurf\Campaign\CampaignOptions
 * @phpstan-import-type CampaignOptionsUpdateShape from \Growsurf\Campaign\CampaignOptions
 */
final class OptionsService implements OptionsContract
{
    /**
     * @api
     */
    public OptionsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new OptionsRawService($client);
    }

    /**
     * @api
     *
     * Retrieves a program's options — the same surface as the dashboard Program Editor's
     * **Options** tab. Includes the attribution model, reward/fraud approval, anti-fraud
     * lists + toggles, referral cookie/credit windows, reCAPTCHA, affiliate enrollment +
     * application review, payout threshold + tax settings (affiliate only),
     * notification-email settings, and the program's languages.
     * `fraud.recaptcha.secretKey` is never returned.
     *
     * @param string $id growSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @return CampaignOptionsShape
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
     * Updates a program's options. Only the fields you send are changed. Some fields are program-type specific (`requireManualRewardApproval`/`autoFulfillRewards` are referral-only; `affiliateApplicationMode`/`affiliateReapplicationPolicy` and `payoutThreshold`/`taxDocumentation` are affiliate-only, and affiliate programs require `requireParticipantAuth: true`). `fraud.recaptcha.secretKey` is write-only. `referralCreditWindowDays: null` means "never expires".
     * Turning on `languages.additionalLanguages` requires the Business plan or higher.
     * While any are on, every `languages` change, including turning them off, requires it
     * too (`403` otherwise).
     * Changes to participant email content are checked before saving. Rejected content
     * returns `400`; if the check is unavailable, `503` asks you to retry. Neither
     * response saves the change. A concurrent edit can return `409`; reload the program
     * before retrying.
     *
     * @param string $id growSurf program ID
     * @param CampaignOptionsUpdateShape $body partial `CampaignOptions` (see API reference)
     * @param RequestOpts|null $requestOptions
     *
     * @return CampaignOptionsShape
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
