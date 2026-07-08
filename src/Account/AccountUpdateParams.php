<?php

declare(strict_types=1);

namespace Growsurf\Account;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Updates your own account profile (`firstName`, `lastName`, `company`). Any other property is rejected with a `400` — in particular, the account `email` cannot be changed via the API, and billing/subscription is not editable here.
 *
 * @see Growsurf\Services\AccountService::update()
 *
 * @phpstan-type AccountUpdateParamsShape = array{
 *   company?: string|null,
 *   firstName?: string|null,
 *   lastName?: string|null,
 * }
 */
final class AccountUpdateParams implements BaseModel
{
    /** @use SdkModel<AccountUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional]
    public ?string $company;

    #[Optional]
    public ?string $firstName;

    #[Optional]
    public ?string $lastName;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $company = null,
        ?string $firstName = null,
        ?string $lastName = null,
    ): self {
        $self = new self;

        null !== $company && $self['company'] = $company;
        null !== $firstName && $self['firstName'] = $firstName;
        null !== $lastName && $self['lastName'] = $lastName;

        return $self;
    }

    public function withCompany(string $company): self
    {
        $self = clone $this;
        $self['company'] = $company;

        return $self;
    }

    public function withFirstName(string $firstName): self
    {
        $self = clone $this;
        $self['firstName'] = $firstName;

        return $self;
    }

    public function withLastName(string $lastName): self
    {
        $self = clone $this;
        $self['lastName'] = $lastName;

        return $self;
    }
}
