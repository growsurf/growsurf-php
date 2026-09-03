<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Campaign\CampaignCreateParams\Goal;
use Growsurf\Campaign\CampaignCreateParams\Type;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Creates a new program, plus any optional campaign rewards. The new program is created in `DRAFT` status and owned by the API key's bound team.
 *
 * @see Growsurf\Services\CampaignService::create()
 *
 * @phpstan-import-type RewardCreateParamsShape from \Growsurf\Campaign\RewardCreateParams
 *
 * @phpstan-type CampaignCreateParamsShape = array{
 *   type: Type|value-of<Type>,
 *   companyLogoImageURL?: string|null,
 *   companyName?: string|null,
 *   currencyISO?: string|null,
 *   goal?: Goal|value-of<Goal>|null,
 *   name?: string|null,
 *   rewards?: list<RewardCreateParams|RewardCreateParamsShape>|null,
 * }
 */
final class CampaignCreateParams implements BaseModel
{
    /** @use SdkModel<CampaignCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The program type. Immutable after creation.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    #[Optional('companyLogoImageUrl')]
    public ?string $companyLogoImageURL;

    #[Optional]
    public ?string $companyName;

    /**
     * ISO 4217 currency code. Defaults to USD. Chosen when the program is created and
     * immutable afterward — it cannot be changed on update.
     */
    #[Optional]
    public ?string $currencyISO;

    /**
     * What the program is for, which seeds share settings that suit that audience.
     * Programs selling to businesses (`CUSTOMERS`, `USERS`, `B2B_SAAS_SELF_SERVICE`,
     * `B2B_SAAS_ENTERPRISE`) start with the LinkedIn share button visible; consumer,
     * financial, education, insurance, newsletter, and waitlist programs
     * (`B2C_SUBSCRIPTIONS`, `FINANCIAL_SERVICES`, `ONLINE_EDUCATION`,
     * `ONLINE_INSURANCE`, `SUBSCRIBERS`, `WAITLIST`) start with it hidden. Omit it and
     * every share button keeps its standard default. Set only when the program is
     * created; it is not accepted on update.
     *
     * @var value-of<Goal>|null $goal
     */
    #[Optional(enum: Goal::class)]
    public ?string $goal;

    /**
     * The program name. Defaults to a generated friendly label plus the creation date.
     */
    #[Optional]
    public ?string $name;

    /**
     * Optional inline rewards to create with the program.
     *
     * @var list<RewardCreateParams>|null $rewards
     */
    #[Optional(list: RewardCreateParams::class)]
    public ?array $rewards;

    /**
     * `new CampaignCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CampaignCreateParams::with(type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CampaignCreateParams)->withType(...)
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
     * @param Type|value-of<Type> $type
     * @param Goal|value-of<Goal> $goal
     * @param list<RewardCreateParams|RewardCreateParamsShape> $rewards
     */
    public static function with(
        Type|string $type,
        ?string $companyLogoImageURL = null,
        ?string $companyName = null,
        ?string $currencyISO = null,
        Goal|string|null $goal = null,
        ?string $name = null,
        ?array $rewards = null,
    ): self {
        $self = new self;

        $self['type'] = $type;

        null !== $companyLogoImageURL && $self['companyLogoImageURL'] = $companyLogoImageURL;
        null !== $companyName && $self['companyName'] = $companyName;
        null !== $currencyISO && $self['currencyISO'] = $currencyISO;
        null !== $goal && $self['goal'] = $goal;
        null !== $name && $self['name'] = $name;
        null !== $rewards && $self['rewards'] = $rewards;

        return $self;
    }

    /**
     * The program type. Immutable after creation.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

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

    /**
     * ISO 4217 currency code. Defaults to USD. Chosen when the program is created and
     * immutable afterward — it cannot be changed on update.
     */
    public function withCurrencyISO(string $currencyISO): self
    {
        $self = clone $this;
        $self['currencyISO'] = $currencyISO;

        return $self;
    }

    /**
     * What the program is for, which seeds share settings that suit that audience.
     * Programs selling to businesses (`CUSTOMERS`, `USERS`, `B2B_SAAS_SELF_SERVICE`,
     * `B2B_SAAS_ENTERPRISE`) start with the LinkedIn share button visible; consumer,
     * financial, education, insurance, newsletter, and waitlist programs
     * (`B2C_SUBSCRIPTIONS`, `FINANCIAL_SERVICES`, `ONLINE_EDUCATION`,
     * `ONLINE_INSURANCE`, `SUBSCRIBERS`, `WAITLIST`) start with it hidden. Omit it and
     * every share button keeps its standard default. Set only when the program is
     * created; it is not accepted on update.
     *
     * @param Goal|value-of<Goal> $goal
     */
    public function withGoal(Goal|string $goal): self
    {
        $self = clone $this;
        $self['goal'] = $goal;

        return $self;
    }

    /**
     * The program name. Defaults to a generated friendly label plus the creation date.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Optional inline rewards to create with the program.
     *
     * @param list<RewardCreateParams|RewardCreateParamsShape> $rewards
     */
    public function withRewards(array $rewards): self
    {
        $self = clone $this;
        $self['rewards'] = $rewards;

        return $self;
    }
}
