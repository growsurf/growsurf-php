<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignActivationAnalyticsResponse;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

final class ActivationOutcomeCount implements BaseModel
{
    /** @use SdkModel<array<string, mixed>> */
    use SdkModel;

    #[Required]
    public int $count;

    public function __construct()
    {
        $this->initialize();
    }
}
