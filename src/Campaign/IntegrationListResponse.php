<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type IntegrationShape from \Growsurf\Campaign\Integration
 *
 * @phpstan-type IntegrationListResponseShape = array{
 *   integrations: list<Integration|IntegrationShape>
 * }
 */
final class IntegrationListResponse implements BaseModel
{
    /** @use SdkModel<IntegrationListResponseShape> */
    use SdkModel;

    /**
     * Every integration this program can connect, in the order the GrowSurf dashboard lists them.
     *
     * @var list<Integration> $integrations
     */
    #[Required(list: Integration::class)]
    public array $integrations;

    /**
     * `new IntegrationListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * IntegrationListResponse::with(integrations: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new IntegrationListResponse)->withIntegrations(...)
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
     * @param list<Integration|IntegrationShape> $integrations
     */
    public static function with(array $integrations): self
    {
        $self = new self;

        $self['integrations'] = $integrations;

        return $self;
    }

    /**
     * Every integration this program can connect, in the order the GrowSurf dashboard lists them.
     *
     * @param list<Integration|IntegrationShape> $integrations
     */
    public function withIntegrations(array $integrations): self
    {
        $self = clone $this;
        $self['integrations'] = $integrations;

        return $self;
    }
}
