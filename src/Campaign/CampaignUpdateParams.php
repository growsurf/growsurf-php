<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Campaign\CampaignUpdateParams\Status;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Updates a program's configuration and/or status. Only the fields you send are changed. `type` and `urlId` are immutable.
 *
 * @see Growsurf\Services\CampaignService::update()
 *
 * @phpstan-type CampaignUpdateParamsShape = array{
 *   companyLogoImageURL?: string|null,
 *   companyName?: string|null,
 *   currencyISO?: string|null,
 *   design?: array<string,mixed>|null,
 *   emails?: array<string,mixed>|null,
 *   goal?: string|null,
 *   installation?: array<string,mixed>|null,
 *   name?: string|null,
 *   notifications?: array<string,mixed>|null,
 *   options?: array<string,mixed>|null,
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
    public ?string $currencyISO;

    /** @var array<string,mixed>|null $design */
    #[Optional(map: 'mixed')]
    public ?array $design;

    /** @var array<string,mixed>|null $emails */
    #[Optional(map: 'mixed')]
    public ?array $emails;

    #[Optional]
    public ?string $goal;

    /** @var array<string,mixed>|null $installation */
    #[Optional(map: 'mixed')]
    public ?array $installation;

    #[Optional]
    public ?string $name;

    /** @var array<string,mixed>|null $notifications */
    #[Optional(map: 'mixed')]
    public ?array $notifications;

    /** @var array<string,mixed>|null $options */
    #[Optional(map: 'mixed')]
    public ?array $options;

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
     * @param array<string,mixed> $design
     * @param array<string,mixed> $emails
     * @param array<string,mixed> $installation
     * @param array<string,mixed> $notifications
     * @param array<string,mixed> $options
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        ?string $companyLogoImageURL = null,
        ?string $companyName = null,
        ?string $currencyISO = null,
        ?array $design = null,
        ?array $emails = null,
        ?string $goal = null,
        ?array $installation = null,
        ?string $name = null,
        ?array $notifications = null,
        ?array $options = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        null !== $companyLogoImageURL && $self['companyLogoImageURL'] = $companyLogoImageURL;
        null !== $companyName && $self['companyName'] = $companyName;
        null !== $currencyISO && $self['currencyISO'] = $currencyISO;
        null !== $design && $self['design'] = $design;
        null !== $emails && $self['emails'] = $emails;
        null !== $goal && $self['goal'] = $goal;
        null !== $installation && $self['installation'] = $installation;
        null !== $name && $self['name'] = $name;
        null !== $notifications && $self['notifications'] = $notifications;
        null !== $options && $self['options'] = $options;
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

    public function withCurrencyISO(string $currencyISO): self
    {
        $self = clone $this;
        $self['currencyISO'] = $currencyISO;

        return $self;
    }

    /**
     * @param array<string,mixed> $design
     */
    public function withDesign(array $design): self
    {
        $self = clone $this;
        $self['design'] = $design;

        return $self;
    }

    /**
     * @param array<string,mixed> $emails
     */
    public function withEmails(array $emails): self
    {
        $self = clone $this;
        $self['emails'] = $emails;

        return $self;
    }

    public function withGoal(string $goal): self
    {
        $self = clone $this;
        $self['goal'] = $goal;

        return $self;
    }

    /**
     * @param array<string,mixed> $installation
     */
    public function withInstallation(array $installation): self
    {
        $self = clone $this;
        $self['installation'] = $installation;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * @param array<string,mixed> $notifications
     */
    public function withNotifications(array $notifications): self
    {
        $self = clone $this;
        $self['notifications'] = $notifications;

        return $self;
    }

    /**
     * @param array<string,mixed> $options
     */
    public function withOptions(array $options): self
    {
        $self = clone $this;
        $self['options'] = $options;

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
