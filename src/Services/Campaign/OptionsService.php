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
     * Retrieves a program's options — the same surface as the dashboard Program Editor's **Options** tab. Includes reward/fraud approval, anti-fraud lists + toggles, referral cookie/credit windows, reCAPTCHA, payout threshold + tax settings (affiliate only), and notification-email settings. `fraud.recaptcha.secretKey` is never returned.
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
     * Updates a program's options. Only the fields you send are changed. Some fields are program-type specific (`requireManualRewardApproval`/`autoFulfillRewards` are referral-only; `payoutThreshold`/`taxDocumentation` are affiliate-only, and affiliate programs require `requireParticipantAuth: true`). `fraud.recaptcha.secretKey` is write-only. `referralCreditWindowDays: null` means "never expires".
     *
     * @param string $id growSurf program ID
     * @param array<string,mixed> $body partial `CampaignOptions` (see API reference)
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
