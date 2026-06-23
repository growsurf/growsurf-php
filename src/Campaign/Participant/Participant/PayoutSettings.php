<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\Participant;

use Growsurf\Campaign\Participant\Participant\PayoutSettings\RequiredAction;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Payout-related actions the participant must complete before a payout can be released (e.g. confirming a PayPal email or submitting a W-9/W-8 tax form). Always present; the requiredActions array is empty when no action is required.
 *
 * @phpstan-type PayoutSettingsShape = array{
 *   requiredActions?: list<RequiredAction|value-of<RequiredAction>>|null
 * }
 */
final class PayoutSettings implements BaseModel
{
    /** @use SdkModel<PayoutSettingsShape> */
    use SdkModel;

    /** @var list<value-of<RequiredAction>>|null $requiredActions */
    #[Optional(list: RequiredAction::class)]
    public ?array $requiredActions;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<RequiredAction|value-of<RequiredAction>>|null $requiredActions
     */
    public static function with(?array $requiredActions = null): self
    {
        $self = new self;

        null !== $requiredActions && $self['requiredActions'] = $requiredActions;

        return $self;
    }

    /**
     * @param list<RequiredAction|value-of<RequiredAction>> $requiredActions
     */
    public function withRequiredActions(array $requiredActions): self
    {
        $self = clone $this;
        $self['requiredActions'] = $requiredActions;

        return $self;
    }
}
