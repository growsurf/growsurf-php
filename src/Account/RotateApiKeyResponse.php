<?php

declare(strict_types=1);

namespace Growsurf\Account;

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

    /**
     * `new RotateApiKeyResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RotateApiKeyResponse::with(apiKey: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RotateApiKeyResponse)->withAPIKey(...)
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
