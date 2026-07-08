<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignGetAnalyticsResponse\StatusCounts;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Affiliate only. Payout counts and amounts by status.
 *
 * @phpstan-import-type PayoutStatusMetricShape from \Growsurf\Campaign\CampaignGetAnalyticsResponse\StatusCounts\PayoutStatusMetric
 *
 * @phpstan-type PayoutStatusShape = array{
 *   failed?: null|PayoutStatusMetric|PayoutStatusMetricShape,
 *   issued?: null|PayoutStatusMetric|PayoutStatusMetricShape,
 *   queued?: null|PayoutStatusMetric|PayoutStatusMetricShape,
 *   upcoming?: null|PayoutStatusMetric|PayoutStatusMetricShape,
 * }
 */
final class PayoutStatus implements BaseModel
{
    /** @use SdkModel<PayoutStatusShape> */
    use SdkModel;

    #[Optional]
    public ?PayoutStatusMetric $failed;

    #[Optional]
    public ?PayoutStatusMetric $issued;

    #[Optional]
    public ?PayoutStatusMetric $queued;

    #[Optional]
    public ?PayoutStatusMetric $upcoming;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param PayoutStatusMetric|PayoutStatusMetricShape|null $failed
     * @param PayoutStatusMetric|PayoutStatusMetricShape|null $issued
     * @param PayoutStatusMetric|PayoutStatusMetricShape|null $queued
     * @param PayoutStatusMetric|PayoutStatusMetricShape|null $upcoming
     */
    public static function with(
        PayoutStatusMetric|array|null $failed = null,
        PayoutStatusMetric|array|null $issued = null,
        PayoutStatusMetric|array|null $queued = null,
        PayoutStatusMetric|array|null $upcoming = null,
    ): self {
        $self = new self;

        null !== $failed && $self['failed'] = $failed;
        null !== $issued && $self['issued'] = $issued;
        null !== $queued && $self['queued'] = $queued;
        null !== $upcoming && $self['upcoming'] = $upcoming;

        return $self;
    }

    /**
     * @param PayoutStatusMetric|PayoutStatusMetricShape $failed
     */
    public function withFailed(PayoutStatusMetric|array $failed): self
    {
        $self = clone $this;
        $self['failed'] = $failed;

        return $self;
    }

    /**
     * @param PayoutStatusMetric|PayoutStatusMetricShape $issued
     */
    public function withIssued(PayoutStatusMetric|array $issued): self
    {
        $self = clone $this;
        $self['issued'] = $issued;

        return $self;
    }

    /**
     * @param PayoutStatusMetric|PayoutStatusMetricShape $queued
     */
    public function withQueued(PayoutStatusMetric|array $queued): self
    {
        $self = clone $this;
        $self['queued'] = $queued;

        return $self;
    }

    /**
     * @param PayoutStatusMetric|PayoutStatusMetricShape $upcoming
     */
    public function withUpcoming(PayoutStatusMetric|array $upcoming): self
    {
        $self = clone $this;
        $self['upcoming'] = $upcoming;

        return $self;
    }
}
