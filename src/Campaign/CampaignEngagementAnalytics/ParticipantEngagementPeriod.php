<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignEngagementAnalytics;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

final class ParticipantEngagementPeriod implements BaseModel
{
    /** @use SdkModel<array<string, mixed>> */
    use SdkModel;

    #[Required]
    public int $from;

    #[Required]
    public int $to;

    #[Required(nullable: true)]
    public ?int $effectiveFrom;

    #[Required]
    public int $previousFrom;

    #[Required]
    public int $previousTo;

    public function __construct()
    {
        $this->initialize();
    }
}
