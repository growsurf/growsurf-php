<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type ProgramResourceFileShape = array{
 *   fileName: string,
 *   mimeType: string,
 *   bytes: int,
 *   format: string,
 *   moderationStatus: 'PENDING'|'APPROVED'|'REJECTED'
 * }
 */
final class ProgramResourceFile implements BaseModel
{
    /** @use SdkModel<ProgramResourceFileShape> */
    use SdkModel;

    #[Required]
    public string $fileName;

    #[Required]
    public string $mimeType;

    #[Required]
    public int $bytes;

    #[Required]
    public string $format;

    #[Required]
    public string $moderationStatus;

    public function __construct()
    {
        $this->initialize();
    }
}
