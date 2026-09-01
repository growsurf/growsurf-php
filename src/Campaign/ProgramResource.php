<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ProgramResourceFileShape from \Growsurf\Campaign\ProgramResourceFile
 *
 * @phpstan-type ProgramResourceShape = array{
 *   id: string,
 *   type: 'FILE'|'LINK'|'TEXT',
 *   title: string,
 *   description: string|null,
 *   category: string|null,
 *   url: string|null,
 *   text: string|null,
 *   file: ProgramResourceFile|ProgramResourceFileShape|null,
 *   isPublished: bool,
 *   position: int,
 *   createdAt: int,
 *   updatedAt: int
 * }
 */
final class ProgramResource implements BaseModel
{
    /** @use SdkModel<ProgramResourceShape> */
    use SdkModel;

    #[Required]
    public string $id;
    #[Required]
    public string $type;
    #[Required]
    public string $title;
    #[Required(nullable: true)]
    public ?string $description;
    #[Required(nullable: true)]
    public ?string $category;
    #[Required(nullable: true)]
    public ?string $url;
    #[Required(nullable: true)]
    public ?string $text;
    #[Required(nullable: true)]
    public ?ProgramResourceFile $file;
    #[Required]
    public bool $isPublished;
    #[Required]
    public int $position;

    /** Unix time in milliseconds when the resource was created. */
    #[Required]
    public int $createdAt;

    /** Unix time in milliseconds when the resource was last updated. */
    #[Required]
    public int $updatedAt;

    public function __construct()
    {
        $this->initialize();
    }
}
