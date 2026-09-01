<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Campaign\CampaignRetrieveActivationAnalyticsParams\CohortInterval;
use Growsurf\Campaign\CampaignRetrieveActivationAnalyticsParams\ObservationWindowDays;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type CampaignRetrieveActivationAnalyticsParamsShape = array{
 *   cohortFrom?: int|null,
 *   cohortTo?: int|null,
 *   cohortInterval?: CohortInterval|value-of<CohortInterval>|null,
 *   observationWindowDays?: ObservationWindowDays|value-of<ObservationWindowDays>|null,
 *   timezone?: string|null,
 * }
 */
final class CampaignRetrieveActivationAnalyticsParams implements BaseModel
{
    /** @use SdkModel<CampaignRetrieveActivationAnalyticsParamsShape> */
    use SdkModel;
    use SdkParams;

    /** Inclusive cohort enrollment start as a Unix timestamp in milliseconds. */
    #[Optional]
    public ?int $cohortFrom;

    /** Exclusive cohort enrollment end as a Unix timestamp in milliseconds. */
    #[Optional]
    public ?int $cohortTo;

    /**
     * Cohort bucket size. Defaults to `day`.
     *
     * @var value-of<CohortInterval>|null $cohortInterval
     */
    #[Optional(enum: CohortInterval::class)]
    public ?string $cohortInterval;

    /**
     * Days after enrollment allowed for each participant to reach a stage. Defaults to `30`.
     *
     * @var value-of<ObservationWindowDays>|null $observationWindowDays
     */
    #[Optional(enum: ObservationWindowDays::class)]
    public ?int $observationWindowDays;

    /** IANA timezone used for cohort bounds. Defaults to `UTC`. */
    #[Optional]
    public ?string $timezone;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct activation cohort query parameters.
     *
     * @param CohortInterval|value-of<CohortInterval>|null $cohortInterval
     * @param ObservationWindowDays|value-of<ObservationWindowDays>|null $observationWindowDays
     */
    public static function with(
        ?int $cohortFrom = null,
        ?int $cohortTo = null,
        CohortInterval|string|null $cohortInterval = null,
        ObservationWindowDays|int|null $observationWindowDays = null,
        ?string $timezone = null,
    ): self {
        $self = new self;

        null !== $cohortFrom && $self['cohortFrom'] = $cohortFrom;
        null !== $cohortTo && $self['cohortTo'] = $cohortTo;
        null !== $cohortInterval && $self['cohortInterval'] = $cohortInterval;
        null !== $observationWindowDays && $self['observationWindowDays'] = $observationWindowDays;
        null !== $timezone && $self['timezone'] = $timezone;

        return $self;
    }

    /** Inclusive cohort enrollment start as a Unix timestamp in milliseconds. */
    public function withCohortFrom(int $cohortFrom): self
    {
        $self = clone $this;
        $self['cohortFrom'] = $cohortFrom;

        return $self;
    }

    /** Exclusive cohort enrollment end as a Unix timestamp in milliseconds. */
    public function withCohortTo(int $cohortTo): self
    {
        $self = clone $this;
        $self['cohortTo'] = $cohortTo;

        return $self;
    }

    /** @param CohortInterval|value-of<CohortInterval> $cohortInterval */
    public function withCohortInterval(CohortInterval|string $cohortInterval): self
    {
        $self = clone $this;
        $self['cohortInterval'] = $cohortInterval;

        return $self;
    }

    /** @param ObservationWindowDays|value-of<ObservationWindowDays> $observationWindowDays */
    public function withObservationWindowDays(ObservationWindowDays|int $observationWindowDays): self
    {
        $self = clone $this;
        $self['observationWindowDays'] = $observationWindowDays;

        return $self;
    }

    /** IANA timezone used for cohort bounds. Defaults to `UTC`. */
    public function withTimezone(string $timezone): self
    {
        $self = clone $this;
        $self['timezone'] = $timezone;

        return $self;
    }
}
