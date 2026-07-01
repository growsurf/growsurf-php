<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Campaign\CampaignCreateParams\Type;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Creates a new program pre-populated with type-appropriate defaults, plus any optional inline rewards. The new program is created in `DRAFT` status and owned by the API key's account.
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
 *   goal?: string|null,
 *   name?: string|null,
 *   options?: array<string,mixed>|null,
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
     * ISO 4217 currency code. Defaults to USD.
     */
    #[Optional]
    public ?string $currencyISO;

    #[Optional]
    public ?string $goal;

    /**
     * The program name. Defaults to "Untitled Program".
     */
    #[Optional]
    public ?string $name;

    /**
     * A curated subset of program options to shallow-merge onto the defaults.
     *
     * @var array<string,mixed>|null $options
     */
    #[Optional(map: 'mixed')]
    public ?array $options;

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
     * @param array<string,mixed> $options
     * @param list<RewardCreateParams|RewardCreateParamsShape> $rewards
     */
    public static function with(
        Type|string $type,
        ?string $companyLogoImageURL = null,
        ?string $companyName = null,
        ?string $currencyISO = null,
        ?string $goal = null,
        ?string $name = null,
        ?array $options = null,
        ?array $rewards = null,
    ): self {
        $self = new self;

        $self['type'] = $type;

        null !== $companyLogoImageURL && $self['companyLogoImageURL'] = $companyLogoImageURL;
        null !== $companyName && $self['companyName'] = $companyName;
        null !== $currencyISO && $self['currencyISO'] = $currencyISO;
        null !== $goal && $self['goal'] = $goal;
        null !== $name && $self['name'] = $name;
        null !== $options && $self['options'] = $options;
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
     * ISO 4217 currency code. Defaults to USD.
     */
    public function withCurrencyISO(string $currencyISO): self
    {
        $self = clone $this;
        $self['currencyISO'] = $currencyISO;

        return $self;
    }

    public function withGoal(string $goal): self
    {
        $self = clone $this;
        $self['goal'] = $goal;

        return $self;
    }

    /**
     * The program name. Defaults to "Untitled Program".
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * A curated subset of program options to shallow-merge onto the defaults.
     *
     * @param array<string,mixed> $options
     */
    public function withOptions(array $options): self
    {
        $self = clone $this;
        $self['options'] = $options;

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
