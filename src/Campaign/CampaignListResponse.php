<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type CampaignShape from \Growsurf\Campaign\Campaign
 *
 * @phpstan-type CampaignListResponseShape = array{
 *   campaigns: list<Campaign|CampaignShape>
 * }
 */
final class CampaignListResponse implements BaseModel
{
    /** @use SdkModel<CampaignListResponseShape> */
    use SdkModel;

    /** @var list<Campaign> $campaigns */
    #[Required(list: Campaign::class)]
    public array $campaigns;

    /**
     * `new CampaignListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CampaignListResponse::with(campaigns: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CampaignListResponse)->withCampaigns(...)
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
     * @param list<Campaign|CampaignShape> $campaigns
     */
    public static function with(array $campaigns): self
    {
        $self = new self;

        $self['campaigns'] = $campaigns;

        return $self;
    }

    /**
     * @param list<Campaign|CampaignShape> $campaigns
     */
    public function withCampaigns(array $campaigns): self
    {
        $self = clone $this;
        $self['campaigns'] = $campaigns;

        return $self;
    }
}
