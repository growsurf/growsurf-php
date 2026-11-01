<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type DeleteCampaignCustomDomainResponseShape = array{
 *   domain: string, success: bool
 * }
 */
final class DeleteCampaignCustomDomainResponse implements BaseModel
{
    /** @use SdkModel<DeleteCampaignCustomDomainResponseShape> */
    use SdkModel;

    /**
     * The custom domain that was removed.
     */
    #[Required]
    public string $domain;

    /**
     * Whether the custom domain was removed.
     */
    #[Required]
    public bool $success;

    /**
     * `new DeleteCampaignCustomDomainResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DeleteCampaignCustomDomainResponse::with(domain: ..., success: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DeleteCampaignCustomDomainResponse)->withDomain(...)->withSuccess(...)
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
    public static function with(string $domain, bool $success): self
    {
        $self = new self;

        $self['domain'] = $domain;
        $self['success'] = $success;

        return $self;
    }

    /**
     * The custom domain that was removed.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    /**
     * Whether the custom domain was removed.
     */
    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }
}
