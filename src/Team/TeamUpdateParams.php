<?php

declare(strict_types=1);

namespace Growsurf\Team;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Updates the name of the team bound to the API key or OAuth connection. Any other property is rejected with a `400`. Personal profiles, billing, and team ownership are not editable here.
 *
 * @see Growsurf\Services\TeamService::update()
 *
 * @phpstan-type TeamUpdateParamsShape = array{name: string}
 */
final class TeamUpdateParams implements BaseModel
{
    /** @use SdkModel<TeamUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The team's display name.
     */
    #[Required]
    public string $name;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $name): self
    {
        $self = new self;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The team's display name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
