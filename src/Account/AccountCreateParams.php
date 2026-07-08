<?php

declare(strict_types=1);

namespace Growsurf\Account;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Creates a new GrowSurf account and returns an API key. This is the only endpoint that does not require an API key.
 *
 * @see Growsurf\Services\AccountService::create()
 *
 * @phpstan-type AccountCreateParamsShape = array{
 *   email: string,
 *   company?: string|null,
 *   firstName?: string|null,
 *   lastName?: string|null,
 * }
 */
final class AccountCreateParams implements BaseModel
{
    /** @use SdkModel<AccountCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The email address for the new account. Personal emails and disposable email addresses are not accepted.
     */
    #[Required]
    public string $email;

    #[Optional]
    public ?string $company;

    #[Optional]
    public ?string $firstName;

    #[Optional]
    public ?string $lastName;

    /**
     * `new AccountCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AccountCreateParams::with(email: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AccountCreateParams)->withEmail(...)
     * ```
     */
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
        string $email,
        ?string $company = null,
        ?string $firstName = null,
        ?string $lastName = null,
    ): self {
        $self = new self;

        $self['email'] = $email;

        null !== $company && $self['company'] = $company;
        null !== $firstName && $self['firstName'] = $firstName;
        null !== $lastName && $self['lastName'] = $lastName;

        return $self;
    }

    /**
     * The email address for the new account. Personal emails and disposable email addresses are not accepted.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

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
