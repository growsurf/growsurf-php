<?php

declare(strict_types=1);

namespace Growsurf\EmailAnalytics;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/** @phpstan-type CountsShape = array{sent: int, delivered: int, opened: int, clicked: int, bounced: int, spamComplaints: int} */
final class Counts implements BaseModel
{
    /** @use SdkModel<CountsShape> */
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

    public function __construct()
    {
        $this->initialize();
    }

    public static function with(
        int $sent,
        int $delivered,
        int $opened,
        int $clicked,
        int $bounced,
        int $spamComplaints,
    ): self {
        $self = new self;
        $self['sent'] = $sent;
        $self['delivered'] = $delivered;
        $self['opened'] = $opened;
        $self['clicked'] = $clicked;
        $self['bounced'] = $bounced;
        $self['spamComplaints'] = $spamComplaints;

        return $self;
    }
}
