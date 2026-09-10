<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * One integration a program can connect, with its current state.
 *
 * @phpstan-type IntegrationShape = array{
 *   id: string,
 *   autoDisabled: bool,
 *   connectURL: string,
 *   connected: bool,
 *   enabled: bool,
 *   name: string,
 * }
 */
final class Integration implements BaseModel
{
    /** @use SdkModel<IntegrationShape> */
    use SdkModel;

    /**
     * Stable integration key, the same value the GrowSurf dashboard uses for this integration.
     */
    #[Required]
    public string $id;

    /**
     * Whether GrowSurf switched the integration off after repeated delivery failures. Its credentials are still stored, but it delivers nothing until it is reconnected in the GrowSurf dashboard.
     */
    #[Required]
    public bool $autoDisabled;

    /**
     * Dashboard link that opens this integration's connect panel in the GrowSurf Program Editor. Give it to the person running the program: connecting an account is a step they complete in the dashboard, and the API cannot do it for them.
     */
    #[Required('connectUrl')]
    public string $connectURL;

    /**
     * Whether the program has stored credentials for this integration.
     */
    #[Required]
    public bool $connected;

    /**
     * Whether the integration is switched on and currently working.
     */
    #[Required]
    public bool $enabled;

    /**
     * Display name, matching what the GrowSurf dashboard calls this integration.
     */
    #[Required]
    public string $name;

    /**
     * `new Integration()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Integration::with(
     *   id: ...,
     *   autoDisabled: ...,
     *   connectURL: ...,
     *   connected: ...,
     *   enabled: ...,
     *   name: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Integration)
     *   ->withID(...)
     *   ->withAutoDisabled(...)
     *   ->withConnectURL(...)
     *   ->withConnected(...)
     *   ->withEnabled(...)
     *   ->withName(...)
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
        string $id,
        bool $autoDisabled,
        string $connectURL,
        bool $connected,
        bool $enabled,
        string $name,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['autoDisabled'] = $autoDisabled;
        $self['connectURL'] = $connectURL;
        $self['connected'] = $connected;
        $self['enabled'] = $enabled;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Stable integration key, the same value the GrowSurf dashboard uses for this integration.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Whether GrowSurf switched the integration off after repeated delivery failures. Its credentials are still stored, but it delivers nothing until it is reconnected in the GrowSurf dashboard.
     */
    public function withAutoDisabled(bool $autoDisabled): self
    {
        $self = clone $this;
        $self['autoDisabled'] = $autoDisabled;

        return $self;
    }

    /**
     * Dashboard link that opens this integration's connect panel in the GrowSurf Program Editor. Give it to the person running the program: connecting an account is a step they complete in the dashboard, and the API cannot do it for them.
     */
    public function withConnectURL(string $connectURL): self
    {
        $self = clone $this;
        $self['connectURL'] = $connectURL;

        return $self;
    }

    /**
     * Whether the program has stored credentials for this integration.
     */
    public function withConnected(bool $connected): self
    {
        $self = clone $this;
        $self['connected'] = $connected;

        return $self;
    }

    /**
     * Whether the integration is switched on and currently working.
     */
    public function withEnabled(bool $enabled): self
    {
        $self = clone $this;
        $self['enabled'] = $enabled;

        return $self;
    }

    /**
     * Display name, matching what the GrowSurf dashboard calls this integration.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
