<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignActivationAnalyticsResponse;

use Growsurf\AnalyticsAvailability;
use Growsurf\AnalyticsUnavailableReason;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

final class CampaignActivationCohortResult implements BaseModel
{
    /** @use SdkModel<array<string, mixed>> */
    use SdkModel;

    #[Required(enum: AnalyticsAvailability::class)]
    public string $state;

    #[Required(enum: AnalyticsUnavailableReason::class, nullable: true)]
    public ?string $reason;

    #[Required]
    public ActivationCohortBounds $cohort;

    /** @var list<ActivationStage>|null $strictStages */
    #[Required(list: ActivationStage::class, nullable: true)]
    public ?array $strictStages;

    #[Required(nullable: true)]
    public ?ActivationStageCounts $rawStageCounts;

    /** @var list<ActivationStalledSegment>|null $stalledSegments */
    #[Required(list: ActivationStalledSegment::class, nullable: true)]
    public ?array $stalledSegments;

    #[Required(nullable: true)]
    public ?ActivationOutcomes $outcomes;

    #[Required(nullable: true)]
    public ?ActivationLargestDrop $largestDrop;

    public function __construct()
    {
        $this->initialize();
    }
}
