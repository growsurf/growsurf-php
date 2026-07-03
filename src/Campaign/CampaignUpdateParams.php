<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Campaign\CampaignUpdateParams\Status;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Updates a program's identity and lifecycle. Only the fields you send are changed. `type`, `urlId`, and `currencyISO` are immutable. Editor-tab configuration (design, emails, options, installation) is edited via the dedicated config sub-resources (e.g. `PATCH /campaign/{id}/emails`), not here.
 *
 * @see Growsurf\Services\CampaignService::update()
 *
 * @phpstan-type CampaignUpdateParamsShape = array{
 *   companyLogoImageURL?: string|null,
 *   companyName?: string|null,
 *   name?: string|null,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class CampaignUpdateParams implements BaseModel
{
    /** @use SdkModel<CampaignUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional('companyLogoImageUrl')]
    public ?string $companyLogoImageURL;

    #[Optional]
    public ?string $companyName;

    #[Optional]
    public ?string $name;

    /**
     * The program status. Transitions are validated; DELETED is not allowed.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        ?string $companyLogoImageURL = null,
        ?string $companyName = null,
        ?string $name = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        null !== $companyLogoImageURL && $self['companyLogoImageURL'] = $companyLogoImageURL;
        null !== $companyName && $self['companyName'] = $companyName;
        null !== $name && $self['name'] = $name;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    public function withCompanyLogoImageURL(string $companyLogoImageURL): self
    {
        $self = clone $this;
        $self['companyLogoImageURL'] = $companyLogoImageURL;

        return $self;
    }

    public function withCompanyName(string $companyName): self
    {
        $self = clone $this;
        $self['companyName'] = $companyName;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The program status. Transitions are validated; DELETED is not allowed.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
