<?php

declare(strict_types=1);

namespace Growsurf;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;
use Growsurf\EmailAnalytics\ByType;

/**
 * Accepted-send and lifecycle metrics for program emails in a requested window.
 *
 * @phpstan-import-type ByTypeShape from \Growsurf\EmailAnalytics\ByType
 *
 * @phpstan-type EmailAnalyticsShape = array{sent: int, delivered: int, opened: int, clicked: int, bounced: int, spamComplaints: int, deliveryRate: float, openRate: float, clickRate: float, bounceRate: float, byType: list<ByType|ByTypeShape>, coverageStartDate: int|null, isPartial: bool}
 */
final class EmailAnalytics implements BaseModel
{
    /** @use SdkModel<EmailAnalyticsShape> */
    use SdkModel;

    #[Required]
    public int $sent;
    #[Required]
    public int $delivered;
    #[Required]
    public int $opened;
    #[Required]
    public int $clicked;
    #[Required]
    public int $bounced;
    #[Required]
    public int $spamComplaints;
    #[Required]
    public float $deliveryRate;
    #[Required]
    public float $openRate;
    #[Required]
    public float $clickRate;
    #[Required]
    public float $bounceRate;

    /** @var list<ByType> $byType */
    #[Required(list: ByType::class)]
    public array $byType;
    #[Required]
    public ?int $coverageStartDate;
    #[Required]
    public bool $isPartial;

    public function __construct()
    {
        $this->initialize();
    }

    /** @param list<ByType|ByTypeShape> $byType */
    public static function with(
        int $sent,
        int $delivered,
        int $opened,
        int $clicked,
        int $bounced,
        int $spamComplaints,
        float $deliveryRate,
        float $openRate,
        float $clickRate,
        float $bounceRate,
        array $byType,
        ?int $coverageStartDate,
        bool $isPartial,
    ): self {
        $self = new self;
        $self['sent'] = $sent;
        $self['delivered'] = $delivered;
        $self['opened'] = $opened;
        $self['clicked'] = $clicked;
        $self['bounced'] = $bounced;
        $self['spamComplaints'] = $spamComplaints;
        $self['deliveryRate'] = $deliveryRate;
        $self['openRate'] = $openRate;
        $self['clickRate'] = $clickRate;
        $self['bounceRate'] = $bounceRate;
        $self['byType'] = $byType;
        $self['coverageStartDate'] = $coverageStartDate;
        $self['isPartial'] = $isPartial;

        return $self;
    }
}
