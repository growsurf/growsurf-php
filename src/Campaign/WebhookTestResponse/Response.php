<?php

declare(strict_types=1);

namespace Growsurf\Campaign\WebhookTestResponse;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type ResponseShape = array{msg?: string|null, statusCode?: int|null}
 */
final class Response implements BaseModel
{
    /** @use SdkModel<ResponseShape> */
    use SdkModel;

    #[Optional]
    public ?string $msg;

    #[Optional]
    public ?int $statusCode;

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
        ?string $msg = null,
        ?int $statusCode = null
    ): self {
        $self = new self;

        null !== $msg && $self['msg'] = $msg;
        null !== $statusCode && $self['statusCode'] = $statusCode;

        return $self;
    }

    public function withMsg(string $msg): self
    {
        $self = clone $this;
        $self['msg'] = $msg;

        return $self;
    }

    public function withStatusCode(int $statusCode): self
    {
        $self = clone $this;
        $self['statusCode'] = $statusCode;

        return $self;
    }
}
