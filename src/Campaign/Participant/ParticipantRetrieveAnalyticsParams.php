<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Campaign\Participant\ParticipantRetrieveAnalyticsParams\Interval;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Retrieves analytics for a single participant — all-time engagement counters, leaderboard ranks, and per-channel share counts (plus affiliate revenue, commission, and payout metrics for affiliate programs). Pass `include=email` for `sent` (accepted for delivery), `delivered`, `opened`, `clicked`, `bounced`, and `spamComplaints` metrics attributed to this participant, including invitations they sent. Use `include=email,series` to include the same counts in each UTC series bucket.
 *
 * @see Growsurf\Services\Campaign\ParticipantService::retrieveAnalytics()
 *
 * @phpstan-type ParticipantRetrieveAnalyticsParamsShape = array{
 *   id: string,
 *   days?: int|null,
 *   endDate?: int|null,
 *   include?: string|null,
 *   interval?: null|Interval|value-of<Interval>,
 *   startDate?: int|null,
 * }
 */
final class ParticipantRetrieveAnalyticsParams implements BaseModel
{
    /** @use SdkModel<ParticipantRetrieveAnalyticsParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * Last number of days to retrieve analytics for. Defaults to 365. Maximum 1825.
     */
    #[Optional]
    public ?int $days;

    /**
     * End date of the analytics timeframe as a Unix timestamp in milliseconds. Required if `days` is not set.
     */
    #[Optional]
    public ?int $endDate;

    /**
     * Comma-separated optional data. `series` returns this participant's own activity per period;
     * `email` returns `sent`, `delivered`, `opened`, `clicked`, `bounced`, `spamComplaints`, and
     * per-email-type metrics attributed to the participant for the requested analytics window
     * (including invitations they sent). Request both in either order to add email counts to
     * every series item for emails sent during that period. Only documented tokens are accepted;
     * an unknown token returns `400`.
     */
    #[Optional]
    public ?string $include;

    /**
     * Bucket size for the `series` (only used when `include` contains `series`). Defaults to
     * `day`.
     *
     * @var value-of<Interval>|null $interval
     */
    #[Optional(enum: Interval::class)]
    public ?string $interval;

    /**
     * Start date of the analytics timeframe as a Unix timestamp in milliseconds. Required if `days` is not set.
     */
    #[Optional]
    public ?int $startDate;

    /**
     * `new ParticipantRetrieveAnalyticsParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantRetrieveAnalyticsParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantRetrieveAnalyticsParams)->withID(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Interval|value-of<Interval>|null $interval
     */
    public static function with(
        string $id,
        ?int $days = null,
        ?int $endDate = null,
        ?string $include = null,
        Interval|string|null $interval = null,
        ?int $startDate = null,
    ): self {
        $self = new self;

        $self['id'] = $id;

        null !== $days && $self['days'] = $days;
        null !== $endDate && $self['endDate'] = $endDate;
        null !== $include && $self['include'] = $include;
        null !== $interval && $self['interval'] = $interval;
        null !== $startDate && $self['startDate'] = $startDate;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Last number of days to retrieve analytics for. Defaults to 365. Maximum 1825.
     */
    public function withDays(int $days): self
    {
        $self = clone $this;
        $self['days'] = $days;

        return $self;
    }

    /**
     * End date of the analytics timeframe as a Unix timestamp in milliseconds. Required if `days` is not set.
     */
    public function withEndDate(int $endDate): self
    {
        $self = clone $this;
        $self['endDate'] = $endDate;

        return $self;
    }

    /**
     * Comma-separated optional data. `series` returns this participant's own activity per period;
     * `email` returns `sent`, `delivered`, `opened`, `clicked`, `bounced`, `spamComplaints`, and
     * per-email-type metrics attributed to the participant for the requested analytics window
     * (including invitations they sent). Request both in either order to add email counts to
     * every series item for emails sent during that period. Only documented tokens are accepted;
     * an unknown token returns `400`.
     */
    public function withInclude(string $include): self
    {
        $self = clone $this;
        $self['include'] = $include;

        return $self;
    }

    /**
     * Bucket size for the `series` (only used when `include` contains `series`). Defaults to
     * `day`.
     *
     * @param Interval|value-of<Interval> $interval
     */
    public function withInterval(Interval|string $interval): self
    {
        $self = clone $this;
        $self['interval'] = $interval;

        return $self;
    }

    /**
     * Start date of the analytics timeframe as a Unix timestamp in milliseconds. Required if `days` is not set.
     */
    public function withStartDate(int $startDate): self
    {
        $self = clone $this;
        $self['startDate'] = $startDate;

        return $self;
    }
}
