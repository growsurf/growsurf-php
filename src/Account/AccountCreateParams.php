<?php

declare(strict_types=1);

namespace Growsurf\Account;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Creates a new GrowSurf account. This is the only endpoint that does not require an API key. Before calling it, an authorized account owner must review and approve GrowSurf's [Terms of Service](https://growsurf.com/terms) and [Privacy Policy](https://growsurf.com/privacy). The account starts a 14-day Business trial without a credit card. The response includes an API key for the new account, shown once in the response. The key is a secret: store it in a secret manager and do not put it in logs, screenshots, URLs, model context, analytics, or generated output. The key is locked until the team owner's email address is verified: authenticated program and resource endpoints return a `403` with error code `EMAIL_NOT_VERIFIED_ERROR` until then (resend the email via `POST /team/owner/verification-email`, then retry). Verification unlocks this same key - keep it and retry rather than requesting a replacement. A welcome email is sent to the address with the verification link and a set-password link for dashboard access. Accounts whose email is never verified are deleted automatically after 7 days. Separately, for security, the API key is replaced the first time the account owner signs in to the GrowSurf dashboard; email verification does not trigger that, and the previous key then returns a `403` with error code `NOT_AUTHORIZED_ERROR`. Some actions (such as emailing participants) additionally require GrowSurf to verify the team first. Calling this endpoint accepts those policies on the account holder's behalf.
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
