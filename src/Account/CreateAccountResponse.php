<?php

declare(strict_types=1);

namespace Growsurf\Account;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type CreateAccountResponseShape = array{
 *   id: string,
 *   email: string,
 *   apiKey: string,
 *   verificationStatus: VerificationStatus|value-of<VerificationStatus>,
 * }
 */
final class CreateAccountResponse implements BaseModel
{
    /** @use SdkModel<CreateAccountResponseShape> */
    use SdkModel;

    /**
     * The new account's unique identifier.
     */
    #[Required]
    public string $id;

    #[Required]
    public string $email;

    /**
     * An API key for the new account. Use it as the `Bearer` token on subsequent requests. Locked (`403` `EMAIL_NOT_VERIFIED_ERROR`) until the account's email is verified, and rotated when the account owner first signs in to the GrowSurf dashboard.
     */
    #[Required]
    public string $apiKey;

    /**
     * @var value-of<VerificationStatus> $verificationStatus
     */
    #[Required(enum: VerificationStatus::class)]
    public string $verificationStatus;

    /**
     * `new CreateAccountResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CreateAccountResponse::with(
     *   id: ...,
     *   email: ...,
     *   apiKey: ...,
     *   verificationStatus: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CreateAccountResponse)
     *   ->withID(...)
     *   ->withEmail(...)
     *   ->withAPIKey(...)
     *   ->withVerificationStatus(...)
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
     *
     * @param VerificationStatus|value-of<VerificationStatus> $verificationStatus
     */
    public static function with(
        string $id,
        string $email,
        string $apiKey,
        VerificationStatus|string $verificationStatus,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['email'] = $email;
        $self['apiKey'] = $apiKey;
        $self['verificationStatus'] = $verificationStatus;

        return $self;
    }

    /**
     * The new account's unique identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * An API key for the new account. Use it as the `Bearer` token on subsequent requests. Locked (`403` `EMAIL_NOT_VERIFIED_ERROR`) until the account's email is verified, and rotated when the account owner first signs in to the GrowSurf dashboard.
     */
    public function withAPIKey(string $apiKey): self
    {
        $self = clone $this;
        $self['apiKey'] = $apiKey;

        return $self;
    }

    /**
     * @param VerificationStatus|value-of<VerificationStatus> $verificationStatus
     */
    public function withVerificationStatus(
        VerificationStatus|string $verificationStatus,
    ): self {
        $self = clone $this;
        $self['verificationStatus'] = $verificationStatus;

        return $self;
    }
}
