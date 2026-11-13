<?php

declare(strict_types=1);

namespace Growsurf\Services\Campaign;

use Growsurf\Campaign\DeleteRewardGroupResponse;
use Growsurf\Campaign\RewardGroup;
use Growsurf\Campaign\RewardGroupListResponse;
use Growsurf\Campaign\RewardGroupRule;
use Growsurf\Client;
use Growsurf\Core\Contracts\BaseResponse;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;

/**
 * Group operations. Groups give some participants a different reward list.
 *
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 * @phpstan-import-type RewardGroupRuleShape from \Growsurf\Campaign\RewardGroupRule
 *
 * @phpstan-type RewardGroupCreateBody = array{
 *   name: string,
 *   rules?: list<RewardGroupRule|RewardGroupRuleShape>
 * }
 * @phpstan-type RewardGroupUpdateBody = array{
 *   name?: string,
 *   order?: int,
 *   rules?: list<RewardGroupRule|RewardGroupRuleShape>
 * }
 */
final class GroupsRawService
{
    public function __construct(private Client $client) {}

    /**
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RewardGroupListResponse>
     *
     * @throws APIException
     */
    public function list(string $id, RequestOptions|array|null $requestOptions = null): BaseResponse
    {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(method: 'get', path: ['campaign/%1$s/groups', $id], options: $requestOptions, convert: RewardGroupListResponse::class);
    }

    /**
     * @param RewardGroupCreateBody $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RewardGroup>
     *
     * @throws APIException
     */
    public function create(string $id, array $params, RequestOptions|array|null $requestOptions = null): BaseResponse
    {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(method: 'post', path: ['campaign/%1$s/groups', $id], body: (object) $params, options: $requestOptions, convert: RewardGroup::class);
    }

    /**
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RewardGroup>
     *
     * @throws APIException
     */
    public function retrieve(string $groupID, string $id, RequestOptions|array|null $requestOptions = null): BaseResponse
    {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(method: 'get', path: ['campaign/%1$s/groups/%2$s', $id, $groupID], options: $requestOptions, convert: RewardGroup::class);
    }

    /**
     * @param RewardGroupUpdateBody $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RewardGroup>
     *
     * @throws APIException
     */
    public function update(string $groupID, string $id, array $params, RequestOptions|array|null $requestOptions = null): BaseResponse
    {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(method: 'patch', path: ['campaign/%1$s/groups/%2$s', $id, $groupID], body: (object) $params, options: $requestOptions, convert: RewardGroup::class);
    }

    /**
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeleteRewardGroupResponse>
     *
     * @throws APIException
     */
    public function delete(string $groupID, string $id, RequestOptions|array|null $requestOptions = null): BaseResponse
    {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(method: 'delete', path: ['campaign/%1$s/groups/%2$s', $id, $groupID], options: $requestOptions, convert: DeleteRewardGroupResponse::class);
    }
}
