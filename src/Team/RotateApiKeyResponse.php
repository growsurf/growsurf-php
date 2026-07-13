<?php

declare(strict_types=1);

namespace Growsurf\Team;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type RotateApiKeyResponseShape = array{apiKey: string}
 */
final class RotateApiKeyResponse implements BaseModel
{
    /** @use SdkModel<RotateApiKeyResponseShape> */
    use SdkModel;

    /**
     * The new API key. Store it now; the key used for rotation stops working immediately.
     */
    #[Required]
    public string $apiKey;

    public function __construct()
    {
        $this->initialize();
    }

    public static function with(string $apiKey): self
    {
        $self = new self;
        $self['apiKey'] = $apiKey;

        return $self;
    }

    /**
     * The new API key. Store it now; the key used for rotation stops working immediately.
     */
    public function withAPIKey(string $apiKey): self
    {
        $self = clone $this;
        $self['apiKey'] = $apiKey;

        return $self;
    }
}
