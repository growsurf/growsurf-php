<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\ParticipantActivationAnalytics;

use Growsurf\Campaign\CampaignActivationAnalyticsResponse\AnchorField;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

final class Cohort implements BaseModel
{
    /** @use SdkModel<array<string, mixed>> */
    use SdkModel;

    #[Required(enum: AnchorField::class)]
    public string $anchorField;

    #[Required(nullable: true)]
    public ?int $anchorAt;

    public function __construct()
    {
        $this->initialize();
    }
}
