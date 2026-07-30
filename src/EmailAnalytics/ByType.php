<?php

declare(strict_types=1);

namespace Growsurf\EmailAnalytics;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/** @phpstan-type ByTypeShape = array{emailType: string, sent: int, delivered: int, opened: int, clicked: int, bounced: int, spamComplaints: int, deliveryRate: float, openRate: float, clickRate: float, bounceRate: float} */
final class ByType implements BaseModel
{
    /** @use SdkModel<ByTypeShape> */
    use SdkModel;

    #[Required]
    public string $emailType;
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

    public function __construct()
    {
        $this->initialize();
    }

    public static function withMetrics(
        string $emailType,
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
    ): self {
        $self = new self;
        $self['emailType'] = $emailType;
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

        return $self;
    }
}
