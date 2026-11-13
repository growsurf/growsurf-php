<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type DeleteRewardGroupResponseShape = array{
 *   id: string, movedToDefault: int, success: bool
 * }
 */
final class DeleteRewardGroupResponse implements BaseModel
{
    /** @use SdkModel<DeleteRewardGroupResponseShape> */
    use SdkModel;

    /** The deleted group ID. */
    #[Required]
    public string $id;

    /** The number of members moved to Default. */
    #[Required]
    public int $movedToDefault;

    /** Whether the group was deleted. */
    #[Required]
    public bool $success;

    public function __construct()
    {
        $this->initialize();
    }
}
