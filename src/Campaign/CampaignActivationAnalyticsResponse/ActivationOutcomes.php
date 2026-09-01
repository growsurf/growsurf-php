<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignActivationAnalyticsResponse;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

final class ActivationOutcomes implements BaseModel
{
    /** @use SdkModel<array<string, mixed>> */
    use SdkModel;

    #[Optional('FIRST_REWARD')]
    public ?ActivationOutcomeCount $firstReward;

    #[Optional('FIRST_COMMISSION')]
    public ?ActivationOutcomeCount $firstCommission;

    #[Optional('PAYOUT_SETUP_COMPLETED')]
    public ?ActivationOutcomeCount $payoutSetupCompleted;

    public function __construct()
    {
        $this->initialize();
    }
}
