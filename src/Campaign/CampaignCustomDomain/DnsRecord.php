<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignCustomDomain;

use Growsurf\Campaign\CampaignCustomDomain\DnsRecord\Type;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * The DNS record to add at your DNS provider.
 *
 * @phpstan-type DnsRecordShape = array{
 *   type: Type|value-of<Type>, name: string, value: string
 * }
 */
final class DnsRecord implements BaseModel
{
    /** @use SdkModel<DnsRecordShape> */
    use SdkModel;

    /**
     * The record type. Always `CNAME`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * The hostname the record is for.
     */
    #[Required]
    public string $name;

    /**
     * The record's target.
     */
    #[Required]
    public string $value;

    /**
     * `new DnsRecord()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DnsRecord::with(type: ..., name: ..., value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DnsRecord)->withType(...)->withName(...)->withValue(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        Type|string $type,
        string $name,
        string $value
    ): self {
        $self = new self;

        $self['type'] = $type;
        $self['name'] = $name;
        $self['value'] = $value;

        return $self;
    }

    /**
     * The record type. Always `CNAME`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The hostname the record is for.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The record's target.
     */
    public function withValue(string $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
