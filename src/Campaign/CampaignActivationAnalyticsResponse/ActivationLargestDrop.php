<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignActivationAnalyticsResponse;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

final class ActivationLargestDrop implements BaseModel
{
    /** @use SdkModel<array<string, mixed>> */
    use SdkModel;

    #[Required]
    public string $fromStage;

    #[Required]
    public string $toStage;

    #[Required]
    public int $count;

    #[Required]
    public float $rate;

    #[Required]
    public string $stalledSegmentKey;

    #[Required(enum: ImprovementAreaKey::class)]
    public string $improvementAreaKey;

    #[Required]
    public string $improvementArea;

    public function __construct()
    {
        $this->initialize();
    }
}
