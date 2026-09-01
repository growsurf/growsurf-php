<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignActivationAnalyticsResponse;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

final class ActivationCohortBounds implements BaseModel
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
    public int $maturedAt;

    #[Required]
    public int $asOf;

    #[Required(enum: AnchorField::class)]
    public string $anchorField;

    public function __construct()
    {
        $this->initialize();
    }
}
