<?php

declare(strict_types=1);

namespace Growsurf\Services\Campaign;

use Growsurf\Campaign\DeleteProgramResourceResponse;
use Growsurf\Campaign\ProgramResource;
use Growsurf\Campaign\ProgramResourceListResponse;
use Growsurf\Campaign\ProgramResourceUploadResult;
use Growsurf\Campaign\ProgramResourceUploadTicket;
use Growsurf\Client;
use Growsurf\RequestOptions;

/**
 * Program Resource management and secure FILE upload operations.
 *
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 * @phpstan-import-type ProgramResourceUploadResultShape from \Growsurf\Campaign\ProgramResourceUploadResult
 *
 * @phpstan-type ProgramResourceUpdateBody = array{
 *   type?: 'FILE'|'LINK'|'TEXT',
 *   title?: string,
 *   description?: string|null,
 *   category?: string|null,
 *   isPublished?: bool,
 *   position?: int,
 *   url?: string,
 *   text?: string,
 *   uploadTicket?: string,
 *   uploadResult?: ProgramResourceUploadResult|ProgramResourceUploadResultShape
 * }
 */
final class ProgramResourcesService
{
    public ProgramResourcesRawService $raw;

    public function __construct(private Client $client)
    {
        $this->raw = new ProgramResourcesRawService($client);
    }

    /** @param RequestOpts|null $requestOptions */
    public function list(string $id, RequestOptions|array|null $requestOptions = null): ProgramResourceListResponse
    {
        return $this->raw->list($id, $requestOptions)->parse();
    }

    /**
     * @param 'FILE'|'LINK'|'TEXT' $type
     * @param ProgramResourceUploadResult|ProgramResourceUploadResultShape|null $uploadResult
     * @param RequestOpts|null $requestOptions
     */
    public function create(string $id, string $type, string $title, ?string $description = null, ?string $category = null, ?bool $isPublished = null, ?string $url = null, ?string $text = null, ?string $uploadTicket = null, ProgramResourceUploadResult|array|null $uploadResult = null, RequestOptions|array|null $requestOptions = null): ProgramResource
    {
        $params = array_filter(
            compact('type', 'title', 'description', 'category', 'isPublished', 'url', 'text', 'uploadTicket', 'uploadResult'),
            static fn (mixed $value): bool => !is_null($value),
        );

        return $this->raw->create($id, $params, $requestOptions)->parse();
    }

    /**
     * @param ProgramResourceUpdateBody $params
     * @param RequestOpts|null $requestOptions
     */
    public function update(string $resourceID, string $id, array $params, RequestOptions|array|null $requestOptions = null): ProgramResource
    {
        return $this->raw->update($resourceID, $id, $params, $requestOptions)->parse();
    }

    /** @param RequestOpts|null $requestOptions */
    public function delete(string $resourceID, string $id, RequestOptions|array|null $requestOptions = null): DeleteProgramResourceResponse
    {
        return $this->raw->delete($resourceID, $id, $requestOptions)->parse();
    }

    /** @param RequestOpts|null $requestOptions */
    public function createUploadTicket(string $id, string $fileName, string $mimeType, int $bytes, RequestOptions|array|null $requestOptions = null): ProgramResourceUploadTicket
    {
        return $this->raw->createUploadTicket($id, compact('fileName', 'mimeType', 'bytes'), $requestOptions)->parse();
    }
}
