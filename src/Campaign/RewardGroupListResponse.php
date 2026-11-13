<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type RewardGroupShape from \Growsurf\Campaign\RewardGroup
 *
 * @phpstan-type RewardGroupListResponseShape = array{
 *   groups: list<RewardGroup|RewardGroupShape>
 * }
 */
final class RewardGroupListResponse implements BaseModel
{
    /** @use SdkModel<RewardGroupListResponseShape> */
    use SdkModel;

    /**
     * The program's groups in display order. Default is not listed.
     *
     * @var list<RewardGroup> $groups
     */
    #[Required(list: RewardGroup::class)]
    public array $groups;

    public function __construct()
    {
        $this->initialize();
    }
}
