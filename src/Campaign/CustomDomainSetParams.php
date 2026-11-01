<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Sets the custom domain for a program's landing pages, or replaces the current one. Send a hostname such as `refer.piedpiper.com`; `https://` is added if you leave it out. Paths, ports, queries and `http://` return a `400`.
 * Replacing a domain removes the old one right away, and its pages stop loading there. Sending the current domain again changes nothing. A domain used by another program returns a `409`.
 * A new domain starts unverified. Point a `CNAME` record from the hostname to the `dnsRecord.value` in the response, then call `POST /campaign/{id}/custom-domain/verify`.
 *
 * @see Growsurf\Services\Campaign\CustomDomainService::set()
 *
 * @phpstan-type CustomDomainSetParamsShape = array{domain: string}
 */
final class CustomDomainSetParams implements BaseModel
{
    /** @use SdkModel<CustomDomainSetParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The hostname to serve the program's landing pages from, with or without `https://`. Up to 255 characters.
     */
    #[Required]
    public string $domain;

    /**
     * `new CustomDomainSetParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CustomDomainSetParams::with(domain: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CustomDomainSetParams)->withDomain(...)
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
    public static function with(string $domain): self
    {
        $self = new self;

        $self['domain'] = $domain;

        return $self;
    }

    /**
     * The hostname to serve the program's landing pages from, with or without `https://`. Up to 255 characters.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }
}
