<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Campaign\CampaignListReferralsParams\SortBy;
use Growsurf\Campaign\Participant\ReferralStatus;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Retrieves a list of all referrals and email invites made by participants in a program.
 *
 * @see Growsurf\Services\CampaignService::listReferrals()
 *
 * @phpstan-type CampaignListReferralsParamsShape = array{
 *   desc?: bool|null,
 *   email?: string|null,
 *   firstName?: string|null,
 *   lastName?: string|null,
 *   limit?: int|null,
 *   nextID?: string|null,
 *   offset?: int|null,
 *   referralStatus?: null|ReferralStatus|value-of<ReferralStatus>,
 *   sortBy?: null|SortBy|value-of<SortBy>,
 * }
 */
final class CampaignListReferralsParams implements BaseModel
{
    /** @use SdkModel<CampaignListReferralsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Return results in descending order when true.
     */
    #[Optional]
    public ?bool $desc;

    /**
     * URL-encoded email value to filter referral results.
     */
    #[Optional]
    public ?string $email;

    /**
     * First name value to filter results.
     */
    #[Optional]
    public ?string $firstName;

    /**
     * Last name value to filter results.
     */
    #[Optional]
    public ?string $lastName;

    /**
     * Number of results to return. Maximum 100.
     */
    #[Optional]
    public ?int $limit;

    /**
     * ID to start the next paged result set with.
     */
    #[Optional]
    public ?string $nextID;

    /**
     * Offset number used to skip through a result set.
     */
    #[Optional]
    public ?int $offset;

    /** @var value-of<ReferralStatus>|null $referralStatus */
    #[Optional(enum: ReferralStatus::class)]
    public ?string $referralStatus;

    /**
     * Field used to sort referral results.
     *
     * @var value-of<SortBy>|null $sortBy
     */
    #[Optional(enum: SortBy::class)]
    public ?string $sortBy;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param ReferralStatus|value-of<ReferralStatus>|null $referralStatus
     * @param SortBy|value-of<SortBy>|null $sortBy
     */
    public static function with(
        ?bool $desc = null,
        ?string $email = null,
        ?string $firstName = null,
        ?string $lastName = null,
        ?int $limit = null,
        ?string $nextID = null,
        ?int $offset = null,
        ReferralStatus|string|null $referralStatus = null,
        SortBy|string|null $sortBy = null,
    ): self {
        $self = new self;

        null !== $desc && $self['desc'] = $desc;
        null !== $email && $self['email'] = $email;
        null !== $firstName && $self['firstName'] = $firstName;
        null !== $lastName && $self['lastName'] = $lastName;
        null !== $limit && $self['limit'] = $limit;
        null !== $nextID && $self['nextID'] = $nextID;
        null !== $offset && $self['offset'] = $offset;
        null !== $referralStatus && $self['referralStatus'] = $referralStatus;
        null !== $sortBy && $self['sortBy'] = $sortBy;

        return $self;
    }

    /**
     * Return results in descending order when true.
     */
    public function withDesc(bool $desc): self
    {
        $self = clone $this;
        $self['desc'] = $desc;

        return $self;
    }

    /**
     * URL-encoded email value to filter referral results.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * First name value to filter results.
     */
    public function withFirstName(string $firstName): self
    {
        $self = clone $this;
        $self['firstName'] = $firstName;

        return $self;
    }

    /**
     * Last name value to filter results.
     */
    public function withLastName(string $lastName): self
    {
        $self = clone $this;
        $self['lastName'] = $lastName;

        return $self;
    }

    /**
     * Number of results to return. Maximum 100.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * ID to start the next paged result set with.
     */
    public function withNextID(string $nextID): self
    {
        $self = clone $this;
        $self['nextID'] = $nextID;

        return $self;
    }

    /**
     * Offset number used to skip through a result set.
     */
    public function withOffset(int $offset): self
    {
        $self = clone $this;
        $self['offset'] = $offset;

        return $self;
    }

    /**
     * @param ReferralStatus|value-of<ReferralStatus> $referralStatus
     */
    public function withReferralStatus(
        ReferralStatus|string $referralStatus
    ): self {
        $self = clone $this;
        $self['referralStatus'] = $referralStatus;

        return $self;
    }

    /**
     * Field used to sort referral results.
     *
     * @param SortBy|value-of<SortBy> $sortBy
     */
    public function withSortBy(SortBy|string $sortBy): self
    {
        $self = clone $this;
        $self['sortBy'] = $sortBy;

        return $self;
    }
}
