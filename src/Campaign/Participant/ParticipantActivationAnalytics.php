<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\AnalyticsAvailability;
use Growsurf\AnalyticsUnavailableReason;
use Growsurf\Campaign\Campaign\Type;
use Growsurf\Campaign\Participant\ParticipantActivationAnalytics\Cohort;
use Growsurf\Campaign\Participant\ParticipantActivationAnalytics\Milestones;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Covered first milestones for one participant. Unknown history remains `null` with an explicit state and reason.
 */
final class ParticipantActivationAnalytics implements BaseModel
{
    /** @use SdkModel<array<string, mixed>> */
    use SdkModel;

    #[Required(nullable: true)]
    public ?int $coverageStartAt;

    #[Required]
    public int $metricContractVersion;

    #[Required(enum: Type::class)]
    public string $programType;

    #[Required(enum: AnalyticsAvailability::class)]
    public string $state;

    #[Required(enum: AnalyticsUnavailableReason::class, nullable: true)]
    public ?string $reason;

    #[Required]
    public Cohort $cohort;

    #[Required(nullable: true)]
    public ?int $enrolledAsAdvocateAt;

    #[Required]
    public Milestones $milestones;

    public function __construct()
    {
        $this->initialize();
    }
}
