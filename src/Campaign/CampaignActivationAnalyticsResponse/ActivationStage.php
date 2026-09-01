<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignActivationAnalyticsResponse;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

final class ActivationStage implements BaseModel
{
    /** @use SdkModel<array<string, mixed>> */
    use SdkModel;

    #[Required(enum: StageKey::class)]
    public string $key;

    #[Required]
    public int $count;

    #[Required(nullable: true)]
    public ?float $conversionRateFromPrior;

    #[Required(nullable: true)]
    public ?float $conversionRateFromEligible;

    #[Required(nullable: true)]
    public ?int $dropOffCount;

    #[Required(nullable: true)]
    public ?float $dropOffRate;

    #[Required(nullable: true)]
    public ?float $medianTimeToStageMs;

    #[Required(enum: StalledSegmentKey::class, nullable: true)]
    public ?string $stalledSegmentKey;

    public function __construct()
    {
        $this->initialize();
    }
}
