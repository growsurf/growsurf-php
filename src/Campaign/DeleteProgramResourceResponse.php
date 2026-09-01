<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type DeleteProgramResourceResponseShape = array{id: string, success: bool}
 */
final class DeleteProgramResourceResponse implements BaseModel
{
    /** @use SdkModel<DeleteProgramResourceResponseShape> */
    use SdkModel;

    #[Required]
    public string $id;
    #[Required]
    public bool $success;

    public function __construct()
    {
        $this->initialize();
    }
}
