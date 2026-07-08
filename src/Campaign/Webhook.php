<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * A program webhook. Secrets are write-only and never returned.
 *
 * @phpstan-type WebhookShape = array{
 *   id: string,
 *   autoDisabledDueToFailures: bool,
 *   events: list<WebhookEvent|value-of<WebhookEvent>>,
 *   failureCount: int,
 *   isEnabled: bool,
 *   lastFailureAt?: int|null,
 *   payloadURL?: string|null,
 * }
 */
final class Webhook implements BaseModel
{
    /** @use SdkModel<WebhookShape> */
    use SdkModel;

    /**
     * The webhook id (`primary` for the program's primary webhook).
     */
    #[Required]
    public string $id;

    /**
     * Read-only. Whether GrowSurf auto-disabled this webhook after repeated delivery failures.
     */
    #[Required]
    public bool $autoDisabledDueToFailures;

    /** @var list<value-of<WebhookEvent>> $events */
    #[Required(list: WebhookEvent::class)]
    public array $events;

    /**
     * Read-only. Consecutive delivery failures.
     */
    #[Required]
    public int $failureCount;

    #[Required]
    public bool $isEnabled;

    /**
     * Read-only. When the last delivery failure occurred, as a Unix timestamp in milliseconds.
     */
    #[Optional(nullable: true)]
    public ?int $lastFailureAt;

    /**
     * The URL that receives webhook deliveries.
     */
    #[Optional('payloadUrl', nullable: true)]
    public ?string $payloadURL;

    /**
     * `new Webhook()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Webhook::with(
     *   id: ...,
     *   autoDisabledDueToFailures: ...,
     *   events: ...,
     *   failureCount: ...,
     *   isEnabled: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Webhook)
     *   ->withID(...)
     *   ->withAutoDisabledDueToFailures(...)
     *   ->withEvents(...)
     *   ->withFailureCount(...)
     *   ->withIsEnabled(...)
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
     * @param list<WebhookEvent|value-of<WebhookEvent>> $events
     */
    public static function with(
        string $id,
        bool $autoDisabledDueToFailures,
        array $events,
        int $failureCount,
        bool $isEnabled,
        ?int $lastFailureAt = null,
        ?string $payloadURL = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['autoDisabledDueToFailures'] = $autoDisabledDueToFailures;
        $self['events'] = $events;
        $self['failureCount'] = $failureCount;
        $self['isEnabled'] = $isEnabled;

        null !== $lastFailureAt && $self['lastFailureAt'] = $lastFailureAt;
        null !== $payloadURL && $self['payloadURL'] = $payloadURL;

        return $self;
    }

    /**
     * The webhook id (`primary` for the program's primary webhook).
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Read-only. Whether GrowSurf auto-disabled this webhook after repeated delivery failures.
     */
    public function withAutoDisabledDueToFailures(
        bool $autoDisabledDueToFailures
    ): self {
        $self = clone $this;
        $self['autoDisabledDueToFailures'] = $autoDisabledDueToFailures;

        return $self;
    }

    /**
     * @param list<WebhookEvent|value-of<WebhookEvent>> $events
     */
    public function withEvents(array $events): self
    {
        $self = clone $this;
        $self['events'] = $events;

        return $self;
    }

    /**
     * Read-only. Consecutive delivery failures.
     */
    public function withFailureCount(int $failureCount): self
    {
        $self = clone $this;
        $self['failureCount'] = $failureCount;

        return $self;
    }

    public function withIsEnabled(bool $isEnabled): self
    {
        $self = clone $this;
        $self['isEnabled'] = $isEnabled;

        return $self;
    }

    /**
     * Read-only. When the last delivery failure occurred, as a Unix timestamp in milliseconds.
     */
    public function withLastFailureAt(?int $lastFailureAt): self
    {
        $self = clone $this;
        $self['lastFailureAt'] = $lastFailureAt;

        return $self;
    }

    /**
     * The URL that receives webhook deliveries.
     */
    public function withPayloadURL(?string $payloadURL): self
    {
        $self = clone $this;
        $self['payloadURL'] = $payloadURL;

        return $self;
    }
}
