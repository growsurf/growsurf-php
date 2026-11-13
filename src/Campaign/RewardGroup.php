<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * A group of participants who earn their own rewards. Its rewards are the Campaign Rewards whose `groupId` is this group's `id`.
 *
 * @phpstan-import-type RewardGroupRuleShape from \Growsurf\Campaign\RewardGroupRule
 *
 * @phpstan-type RewardGroupShape = array{
 *   id: string,
 *   name: string,
 *   order: int,
 *   rules: list<RewardGroupRule|RewardGroupRuleShape>,
 *   signupCode: string,
 *   createdAt: int,
 *   updatedAt: int
 * }
 */
final class RewardGroup implements BaseModel
{
    /** @use SdkModel<RewardGroupShape> */
    use SdkModel;

    /** The group ID. Participants, Campaign Rewards, and participant rewards name it as `groupId`. */
    #[Required]
    public string $id;

    /** The group name (internal only, never shown to participants). */
    #[Required]
    public string $name;

    /** The group's position in the program's group list. */
    #[Required]
    public int $order;

    /**
     * The rules that place participants in this group.
     *
     * @var list<RewardGroupRule> $rules
     */
    #[Required(list: RewardGroupRule::class)]
    public array $rules;

    /** The code for this group's signup link. A participant who signs up through the link joins this group. */
    #[Required]
    public string $signupCode;

    /** When the group was created, in Unix milliseconds. */
    #[Required]
    public int $createdAt;

    /** When the group was last changed, in Unix milliseconds. */
    #[Required]
    public int $updatedAt;

    public function __construct()
    {
        $this->initialize();
    }
}
