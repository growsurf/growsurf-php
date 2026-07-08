<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Campaign\WebhookTestResponse\Response;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ResponseShape from \Growsurf\Campaign\WebhookTestResponse\Response
 *
 * @phpstan-type WebhookTestResponseShape = array{
 *   success: bool,
 *   payload?: array<string,mixed>|null,
 *   response?: null|Response|ResponseShape,
 * }
 */
final class WebhookTestResponse implements BaseModel
{
    /** @use SdkModel<WebhookTestResponseShape> */
    use SdkModel;

    #[Required]
    public bool $success;

    /**
     * The mock event payload that was sent.
     *
     * @var array<string,mixed>|null $payload
     */
    #[Optional(map: 'mixed')]
    public ?array $payload;

    #[Optional]
    public ?Response $response;

    /**
     * `new WebhookTestResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookTestResponse::with(success: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookTestResponse)->withSuccess(...)
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
     * @param array<string,mixed>|null $payload
     * @param Response|ResponseShape|null $response
     */
    public static function with(
        bool $success,
        ?array $payload = null,
        Response|array|null $response = null,
    ): self {
        $self = new self;

        $self['success'] = $success;

        null !== $payload && $self['payload'] = $payload;
        null !== $response && $self['response'] = $response;

        return $self;
    }

    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }

    /**
     * The mock event payload that was sent.
     *
     * @param array<string,mixed> $payload
     */
    public function withPayload(array $payload): self
    {
        $self = clone $this;
        $self['payload'] = $payload;

        return $self;
    }

    /**
     * @param Response|ResponseShape $response
     */
    public function withResponse(Response|array $response): self
    {
        $self = clone $this;
        $self['response'] = $response;

        return $self;
    }
}
