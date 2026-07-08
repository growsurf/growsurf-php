<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignGetAnalyticsResponse\StatusCounts;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Affiliate only. Commission counts and amounts by status.
 *
 * @phpstan-import-type CommissionStatusMetricShape from \Growsurf\Campaign\CampaignGetAnalyticsResponse\StatusCounts\CommissionStatusMetric
 *
 * @phpstan-type CommissionStatusShape = array{
 *   approved?: null|CommissionStatusMetric|CommissionStatusMetricShape,
 *   paid?: null|CommissionStatusMetric|CommissionStatusMetricShape,
 *   pending?: null|CommissionStatusMetric|CommissionStatusMetricShape,
 *   reversed?: null|CommissionStatusMetric|CommissionStatusMetricShape,
 * }
 */
final class CommissionStatus implements BaseModel
{
    /** @use SdkModel<CommissionStatusShape> */
    use SdkModel;

    #[Optional]
    public ?CommissionStatusMetric $approved;

    #[Optional]
    public ?CommissionStatusMetric $paid;

    #[Optional]
    public ?CommissionStatusMetric $pending;

    #[Optional]
    public ?CommissionStatusMetric $reversed;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param CommissionStatusMetric|CommissionStatusMetricShape|null $approved
     * @param CommissionStatusMetric|CommissionStatusMetricShape|null $paid
     * @param CommissionStatusMetric|CommissionStatusMetricShape|null $pending
     * @param CommissionStatusMetric|CommissionStatusMetricShape|null $reversed
     */
    public static function with(
        CommissionStatusMetric|array|null $approved = null,
        CommissionStatusMetric|array|null $paid = null,
        CommissionStatusMetric|array|null $pending = null,
        CommissionStatusMetric|array|null $reversed = null,
    ): self {
        $self = new self;

        null !== $approved && $self['approved'] = $approved;
        null !== $paid && $self['paid'] = $paid;
        null !== $pending && $self['pending'] = $pending;
        null !== $reversed && $self['reversed'] = $reversed;

        return $self;
    }

    /**
     * @param CommissionStatusMetric|CommissionStatusMetricShape $approved
     */
    public function withApproved(CommissionStatusMetric|array $approved): self
    {
        $self = clone $this;
        $self['approved'] = $approved;

        return $self;
    }

    /**
     * @param CommissionStatusMetric|CommissionStatusMetricShape $paid
     */
    public function withPaid(CommissionStatusMetric|array $paid): self
    {
        $self = clone $this;
        $self['paid'] = $paid;

        return $self;
    }

    /**
     * @param CommissionStatusMetric|CommissionStatusMetricShape $pending
     */
    public function withPending(CommissionStatusMetric|array $pending): self
    {
        $self = clone $this;
        $self['pending'] = $pending;

        return $self;
    }

    /**
     * @param CommissionStatusMetric|CommissionStatusMetricShape $reversed
     */
    public function withReversed(CommissionStatusMetric|array $reversed): self
    {
        $self = clone $this;
        $self['reversed'] = $reversed;

        return $self;
    }
}
