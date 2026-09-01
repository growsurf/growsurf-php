<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignActivationAnalyticsResponse;

use Growsurf\Campaign\CampaignActivationAnalyticsResponse\ActivationStalledSegment\FromStage;
use Growsurf\Campaign\CampaignActivationAnalyticsResponse\ActivationStalledSegment\ToStage;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

final class ActivationStalledSegment implements BaseModel
{
    /** @use SdkModel<array<string, mixed>> */
    use SdkModel;

    #[Required(enum: StalledSegmentKey::class)]
    public string $key;

    #[Required(enum: FromStage::class)]
    public string $fromStage;

    #[Required(enum: ToStage::class)]
    public string $toStage;

    #[Required]
    public int $count;

    public function __construct()
    {
        $this->initialize();
    }
}
