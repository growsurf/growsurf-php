<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type RewardGroupRuleShape = array{
 *   type: RewardGroupRuleType|value-of<RewardGroupRuleType>, value: string
 * }
 */
final class RewardGroupRule implements BaseModel
{
    /** @use SdkModel<RewardGroupRuleShape> */
    use SdkModel;

    /**
     * The kind of rule.
     *
     * @var value-of<RewardGroupRuleType> $type
     */
    #[Required(enum: RewardGroupRuleType::class)]
    public string $type;

    /** The participant ID, email address, or domain. 1 to 254 characters. */
    #[Required]
    public string $value;

    public function __construct()
    {
        $this->initialize();
    }

    /** @param RewardGroupRuleType|value-of<RewardGroupRuleType> $type */
    public static function with(RewardGroupRuleType|string $type, string $value): self
    {
        $self = new self;

        $self['type'] = $type;
        $self['value'] = $value;

        return $self;
    }
}
