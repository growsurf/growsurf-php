<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Campaign\Campaign\Type;
use Growsurf\Campaign\CampaignActivationAnalyticsResponse\CampaignActivationCohortResult;
use Growsurf\Campaign\CampaignActivationAnalyticsResponse\PortalViewedLabel;
use Growsurf\Campaign\CampaignRetrieveActivationAnalyticsParams\CohortInterval;
use Growsurf\Campaign\CampaignRetrieveActivationAnalyticsParams\ObservationWindowDays;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/** Activation cohorts for eligible participants in a referral or affiliate program. */
final class CampaignActivationAnalyticsResponse implements BaseModel
{
    /** @use SdkModel<array<string, mixed>> */
    use SdkModel;

    #[Required(nullable: true)]
    public ?int $coverageStartAt;

    #[Required]
    public int $metricContractVersion;

    #[Required(enum: Type::class)]
    public string $programType;

    #[Required]
    public string $timezone;

    #[Required(enum: CohortInterval::class)]
    public string $cohortInterval;

    #[Required(enum: ObservationWindowDays::class)]
    public int $observationWindowDays;

    #[Required(enum: PortalViewedLabel::class)]
    public string $portalViewedLabel;

    #[Required]
    public string $portalViewedHelperText;

    #[Required]
    public CampaignActivationCohortResult $aggregate;

    /** @var list<CampaignActivationCohortResult> $cohorts */
    #[Required(list: CampaignActivationCohortResult::class)]
    public array $cohorts;

    public function __construct()
    {
        $this->initialize();
    }
}
