<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type DeleteWebhookResponseShape = array{id: string, success: bool}
 */
final class DeleteWebhookResponse implements BaseModel
{
    /** @use SdkModel<DeleteWebhookResponseShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required]
    public bool $success;

    /**
     * `new DeleteWebhookResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DeleteWebhookResponse::with(id: ..., success: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DeleteWebhookResponse)->withID(...)->withSuccess(...)
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
    public static function with(string $id, bool $success): self
    {
        $self = new self;

        $self['id'] = $id;
        $self['success'] = $success;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }
}
