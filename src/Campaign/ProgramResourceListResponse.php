<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ProgramResourceShape from \Growsurf\Campaign\ProgramResource
 *
 * @phpstan-type ProgramResourceListResponseShape = array{
 *   resources: list<ProgramResource|ProgramResourceShape>
 * }
 */
final class ProgramResourceListResponse implements BaseModel
{
    /** @use SdkModel<ProgramResourceListResponseShape> */
    use SdkModel;

    /** @var list<ProgramResource> $resources */
    #[Required(list: ProgramResource::class)]
    public array $resources;

    public function __construct()
    {
        $this->initialize();
    }
}
