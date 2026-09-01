<?php

declare(strict_types=1);

namespace Growsurf\Services\Campaign;

use Growsurf\Campaign\DeleteProgramResourceResponse;
use Growsurf\Campaign\ProgramResource;
use Growsurf\Campaign\ProgramResourceListResponse;
use Growsurf\Campaign\ProgramResourceUploadResult;
use Growsurf\Campaign\ProgramResourceUploadTicket;
use Growsurf\Client;
use Growsurf\Core\Contracts\BaseResponse;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;

/**
 * Program Resource management and secure FILE upload operations.
 *
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 * @phpstan-import-type ProgramResourceUploadResultShape from \Growsurf\Campaign\ProgramResourceUploadResult
 *
 * @phpstan-type ProgramResourceCreateBody = array{
 *   type: 'FILE'|'LINK'|'TEXT',
 *   title: string,
 *   description?: string|null,
 *   category?: string|null,
 *   isPublished?: bool,
 *   url?: string,
 *   text?: string,
 *   uploadTicket?: string,
 *   uploadResult?: ProgramResourceUploadResult|ProgramResourceUploadResultShape
 * }
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
final class ProgramResourcesRawService
{
    public function __construct(private Client $client) {}

    /**
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProgramResourceListResponse>
     *
     * @throws APIException
     */
    public function list(string $id, RequestOptions|array|null $requestOptions = null): BaseResponse
    {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(method: 'get', path: ['campaign/%1$s/resources', $id], options: $requestOptions, convert: ProgramResourceListResponse::class);
    }

    /**
     * @param ProgramResourceCreateBody $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProgramResource>
     *
     * @throws APIException
     */
    public function create(string $id, array $params, RequestOptions|array|null $requestOptions = null): BaseResponse
    {
        self::validateWrite($params, creating: true);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(method: 'post', path: ['campaign/%1$s/resources', $id], body: (object) $params, options: $requestOptions, convert: ProgramResource::class);
    }

    /**
     * @param ProgramResourceUpdateBody $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProgramResource>
     *
     * @throws APIException
     */
    public function update(string $resourceID, string $id, array $params, RequestOptions|array|null $requestOptions = null): BaseResponse
    {
        self::validateWrite($params, creating: false);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(method: 'patch', path: ['campaign/%1$s/resources/%2$s', $id, $resourceID], body: (object) $params, options: $requestOptions, convert: ProgramResource::class);
    }

    /**
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeleteProgramResourceResponse>
     *
     * @throws APIException
     */
    public function delete(string $resourceID, string $id, RequestOptions|array|null $requestOptions = null): BaseResponse
    {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(method: 'delete', path: ['campaign/%1$s/resources/%2$s', $id, $resourceID], options: $requestOptions, convert: DeleteProgramResourceResponse::class);
    }

    /**
     * @param array{fileName: string, mimeType: string, bytes: int} $params fileName must contain 1 through 120 characters
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProgramResourceUploadTicket>
     *
     * @throws APIException
     */
    public function createUploadTicket(string $id, array $params, RequestOptions|array|null $requestOptions = null): BaseResponse
    {
        $fileNameLength = mb_strlen($params['fileName'], 'UTF-8');
        if ($fileNameLength < 1 || $fileNameLength > 120) {
            throw new \InvalidArgumentException('Program Resource fileName must contain 1 through 120 characters');
        }

        // @phpstan-ignore-next-line return.type
        return $this->client->request(method: 'post', path: ['campaign/%1$s/resource-upload-tickets', $id], body: (object) $params, options: $requestOptions, convert: ProgramResourceUploadTicket::class);
    }

    /**
     * Reject Resource field combinations excluded by the public REST contract.
     *
     * @param array<string,mixed> $params
     */
    private static function validateWrite(array $params, bool $creating): void
    {
        if (!$creating && [] === $params) {
            throw new \InvalidArgumentException('Program Resource update requires at least one field');
        }

        if (array_key_exists('position', $params)
            && (!is_int($params['position']) || $params['position'] < 0 || $params['position'] > 99)) {
            throw new \InvalidArgumentException('Program Resource position must be an integer from 0 through 99');
        }

        $hasUploadTicket = array_key_exists('uploadTicket', $params);
        $hasUploadResult = array_key_exists('uploadResult', $params);
        if ($hasUploadTicket !== $hasUploadResult) {
            throw new \InvalidArgumentException('uploadTicket and uploadResult must be supplied together');
        }

        $suppliedTypes = [];
        if (array_key_exists('url', $params)) {
            $suppliedTypes[] = 'LINK';
        }
        if (array_key_exists('text', $params)) {
            $suppliedTypes[] = 'TEXT';
        }
        if ($hasUploadTicket) {
            $suppliedTypes[] = 'FILE';
        }
        if (count($suppliedTypes) > 1) {
            throw new \InvalidArgumentException('Send content fields for only one Program Resource type');
        }

        $type = $params['type'] ?? null;
        if ([] !== $suppliedTypes && null !== $type && $suppliedTypes[0] !== $type) {
            throw new \InvalidArgumentException('Content fields must match the selected Program Resource type');
        }
        if ($creating && ([] === $suppliedTypes || $suppliedTypes[0] !== $type)) {
            throw new \InvalidArgumentException('Create requires content fields for the selected Program Resource type');
        }
    }
}
