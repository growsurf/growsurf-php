<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type ProgramResourceUploadTicketShape = array{
 *   ticket: string,
 *   expiresIn: int,
 *   uploadURL: string,
 *   uploadParameters: array<string,string|int|float|bool>
 * }
 */
final class ProgramResourceUploadTicket implements BaseModel
{
    /** @use SdkModel<ProgramResourceUploadTicketShape> */
    use SdkModel;

    #[Required]
    public string $ticket;
    #[Required]
    public int $expiresIn;
    #[Required('uploadUrl')]
    public string $uploadURL;

    /** @var array<string,string|int|float|bool> $uploadParameters */
    #[Required(map: 'mixed')]
    public array $uploadParameters;

    public function __construct()
    {
        $this->initialize();
    }
}
