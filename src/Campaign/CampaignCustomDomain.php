<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Campaign\CampaignCustomDomain\DnsRecord;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * The custom domain that serves a program's landing pages.
 *
 * @phpstan-import-type DnsRecordShape from \Growsurf\Campaign\CampaignCustomDomain\DnsRecord
 *
 * @phpstan-type CampaignCustomDomainShape = array{
 *   domain: string|null,
 *   isVerified: bool,
 *   verifiedAt: int|null,
 *   dnsRecord: null|DnsRecord|DnsRecordShape,
 *   createdAt: int|null,
 *   updatedAt: int|null,
 * }
 */
final class CampaignCustomDomain implements BaseModel
{
    /** @use SdkModel<CampaignCustomDomainShape> */
    use SdkModel;

    /**
     * The custom domain, or `null` when none is set.
     */
    #[Required(nullable: true)]
    public ?string $domain;

    /**
     * Whether the domain's `CNAME` record pointed to `dnsRecord.value` at the last check. Landing pages load on the domain only when this is `true`.
     */
    #[Required]
    public bool $isVerified;

    /**
     * When the DNS check passed, in epoch milliseconds. `null` while unverified.
     */
    #[Required(nullable: true)]
    public ?int $verifiedAt;

    /**
     * The DNS record to add at your DNS provider. `null` when no domain is set.
     */
    #[Required(nullable: true)]
    public ?DnsRecord $dnsRecord;

    /**
     * When the domain was set, in epoch milliseconds. `null` when no domain is set.
     */
    #[Required(nullable: true)]
    public ?int $createdAt;

    /**
     * When the domain record last changed, in epoch milliseconds. `null` when no domain is set.
     */
    #[Required(nullable: true)]
    public ?int $updatedAt;

    /**
     * `new CampaignCustomDomain()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CampaignCustomDomain::with(
     *   domain: ...,
     *   isVerified: ...,
     *   verifiedAt: ...,
     *   dnsRecord: ...,
     *   createdAt: ...,
     *   updatedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CampaignCustomDomain)
     *   ->withDomain(...)
     *   ->withIsVerified(...)
     *   ->withVerifiedAt(...)
     *   ->withDnsRecord(...)
     *   ->withCreatedAt(...)
     *   ->withUpdatedAt(...)
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
     * @param DnsRecord|DnsRecordShape|null $dnsRecord
     */
    public static function with(
        ?string $domain,
        bool $isVerified,
        ?int $verifiedAt,
        DnsRecord|array|null $dnsRecord,
        ?int $createdAt,
        ?int $updatedAt,
    ): self {
        $self = new self;

        $self['domain'] = $domain;
        $self['isVerified'] = $isVerified;
        $self['verifiedAt'] = $verifiedAt;
        $self['dnsRecord'] = $dnsRecord;
        $self['createdAt'] = $createdAt;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * The custom domain, or `null` when none is set.
     */
    public function withDomain(?string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    /**
     * Whether the domain's `CNAME` record pointed to `dnsRecord.value` at the last check. Landing pages load on the domain only when this is `true`.
     */
    public function withIsVerified(bool $isVerified): self
    {
        $self = clone $this;
        $self['isVerified'] = $isVerified;

        return $self;
    }

    /**
     * When the DNS check passed, in epoch milliseconds. `null` while unverified.
     */
    public function withVerifiedAt(?int $verifiedAt): self
    {
        $self = clone $this;
        $self['verifiedAt'] = $verifiedAt;

        return $self;
    }

    /**
     * The DNS record to add at your DNS provider. `null` when no domain is set.
     *
     * @param DnsRecord|DnsRecordShape|null $dnsRecord
     */
    public function withDnsRecord(DnsRecord|array|null $dnsRecord): self
    {
        $self = clone $this;
        $self['dnsRecord'] = $dnsRecord;

        return $self;
    }

    /**
     * When the domain was set, in epoch milliseconds. `null` when no domain is set.
     */
    public function withCreatedAt(?int $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * When the domain record last changed, in epoch milliseconds. `null` when no domain is set.
     */
    public function withUpdatedAt(?int $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }
}
