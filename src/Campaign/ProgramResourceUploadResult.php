<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * The unmodified signed result returned after uploading with a GrowSurf ticket.
 *
 * @phpstan-type ProgramResourceUploadResultShape = array{
 *   asset_id?: string,
 *   public_id: string,
 *   version: int,
 *   signature: string,
 *   resource_type: 'image'|'raw',
 *   type: 'authenticated',
 *   bytes: int,
 *   secure_url: string,
 *   format?: string,
 *   ...<string,mixed>
 * }
 */
final class ProgramResourceUploadResult implements BaseModel
{
    /** @use SdkModel<ProgramResourceUploadResultShape> */
    use SdkModel;

    #[Optional]
    public ?string $asset_id;
    #[Required]
    public string $public_id;
    #[Required]
    public int $version;
    #[Required]
    public string $signature;

    /** @var 'image'|'raw' $resource_type */
    #[Required]
    public string $resource_type;

    /** @var 'authenticated' $type */
    #[Required]
    public string $type;
    #[Required]
    public int $bytes;
    #[Required]
    public string $secure_url;
    #[Optional]
    public ?string $format;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * @param 'image'|'raw' $resource_type
     * @param 'authenticated' $type
     */
    public static function with(
        string $public_id,
        int $version,
        string $signature,
        string $resource_type,
        int $bytes,
        string $secure_url,
        ?string $asset_id = null,
        string $type = 'authenticated',
        ?string $format = null,
    ): self {
        $self = new self;

        $self['public_id'] = $public_id;
        $self['version'] = $version;
        $self['signature'] = $signature;
        $self['resource_type'] = $resource_type;
        $self['type'] = $type;
        $self['bytes'] = $bytes;
        $self['secure_url'] = $secure_url;
        null !== $asset_id && $self['asset_id'] = $asset_id;
        null !== $format && $self['format'] = $format;

        return $self;
    }
}
