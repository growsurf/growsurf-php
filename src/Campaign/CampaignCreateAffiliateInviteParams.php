<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Invites someone to join the affiliate program. GrowSurf emails them a single-use accept link; accepting it enrolls them as an approved affiliate without going through the public application. One active invite can exist per email address.
 *
 * @see Growsurf\Services\CampaignService::createAffiliateInvite()
 *
 * @phpstan-type CampaignCreateAffiliateInviteParamsShape = array{
 *   email: string, firstName?: string, lastName?: string
 * }
 */
final class CampaignCreateAffiliateInviteParams implements BaseModel
{
    /** @use SdkModel<CampaignCreateAffiliateInviteParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Valid email address to invite. Maximum 255 characters.
     */
    #[Required]
    public string $email;

    /**
     * Invitee first name, used in the invite email. Maximum 255 characters.
     */
    #[Optional]
    public ?string $firstName;

    /**
     * Invitee last name. Maximum 255 characters.
     */
    #[Optional]
    public ?string $lastName;

    /**
     * `new CampaignCreateAffiliateInviteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CampaignCreateAffiliateInviteParams::with(email: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CampaignCreateAffiliateInviteParams)->withEmail(...)
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
        ?string $firstName = null,
        ?string $lastName = null,
    ): self {
        $self = new self;

        $self['email'] = $email;

        null !== $firstName && $self['firstName'] = $firstName;
        null !== $lastName && $self['lastName'] = $lastName;

        return $self;
    }

    /**
     * Valid email address to invite. Maximum 255 characters.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * Invitee first name, used in the invite email. Maximum 255 characters.
     */
    public function withFirstName(string $firstName): self
    {
        $self = clone $this;
        $self['firstName'] = $firstName;

        return $self;
    }

    /**
     * Invitee last name. Maximum 255 characters.
     */
    public function withLastName(string $lastName): self
    {
        $self = clone $this;
        $self['lastName'] = $lastName;

        return $self;
    }
}
