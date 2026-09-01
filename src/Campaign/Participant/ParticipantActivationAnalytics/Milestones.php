<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\ParticipantActivationAnalytics;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Covered first milestones. A `null` value means unavailable history, not that the action never happened.
 */
final class Milestones implements BaseModel
{
    /** @use SdkModel<array<string, mixed>> */
    use SdkModel;

    #[Required(nullable: true)]
    public ?int $firstPortalViewedAt;

    #[Required(nullable: true)]
    public ?int $firstReferralLinkCopiedAt;

    #[Required(nullable: true)]
    public ?int $firstShareAt;

    #[Required(enum: FirstShareChannel::class, nullable: true)]
    public ?string $firstShareChannel;

    #[Required(nullable: true)]
    public ?int $firstUniqueClickAt;

    #[Required(nullable: true)]
    public ?int $firstLeadAt;

    #[Required(nullable: true)]
    public ?int $firstReferralAt;

    #[Required(nullable: true)]
    public ?int $firstRewardAt;

    #[Required(nullable: true)]
    public ?int $firstCommissionAt;

    #[Required(nullable: true)]
    public ?int $payoutSetupCompletedAt;

    public function __construct()
    {
        $this->initialize();
    }
}
