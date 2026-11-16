<?php

declare(strict_types=1);

namespace Growsurf\Services\Campaign;

use Growsurf\Campaign\DeleteRewardGroupResponse;
use Growsurf\Campaign\RewardGroup;
use Growsurf\Campaign\RewardGroupListResponse;
use Growsurf\Campaign\RewardGroupRule;
use Growsurf\Client;
use Growsurf\Core\Exceptions\APIException;
use Growsurf\RequestOptions;

/**
 * Group operations. Groups give some participants a different reward list.
 *
 * @phpstan-import-type RequestOpts from \Growsurf\RequestOptions
 * @phpstan-import-type RewardGroupRuleShape from \Growsurf\Campaign\RewardGroupRule
 *
 * @phpstan-type RewardGroupUpdateBody = array{
 *   name?: string,
 *   order?: int,
 *   rules?: list<RewardGroupRule|RewardGroupRuleShape>
 * }
 */
final class GroupsService
{
    /** @api */
    public GroupsRawService $raw;

    public function __construct(private Client $client)
    {
        $this->raw = new GroupsRawService($client);
    }

    /**
     * @api
     *
     * Lists the program's groups in display order. Groups give some participants a different reward list. Each participant is in one group, and `groupId: null` is Default, which holds the program's standard rewards and is not in this list. A group's rewards replace Default's whole reward list for its members' new referrals. Leaderboard rewards stay program-wide.
     *
     * @param string $id GrowSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(string $id, RequestOptions|array|null $requestOptions = null): RewardGroupListResponse
    {
        return $this->raw->list($id, $requestOptions)->parse();
    }

    /**
     * @api
     *
     * Creates an empty group. Add Campaign Rewards with its `groupId` before adding participants or rules. Omit `rules` or send an empty array; nonempty rules return `400`. Group names must be unique, ignoring case. Duplicate names return `409`; "Default" returns `400`.
     *
     * @param string $id GrowSurf program ID
     * @param string $name The group name (internal only, never shown to participants). 1 to 100 characters.
     * @param list<RewardGroupRule|RewardGroupRuleShape>|null $rules Omit or send an empty array. Add rules after configuring a reward.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(string $id, string $name, ?array $rules = null, RequestOptions|array|null $requestOptions = null): RewardGroup
    {
        $params = array_filter(
            compact('name', 'rules'),
            static fn (mixed $value): bool => !is_null($value),
        );

        return $this->raw->create($id, $params, $requestOptions)->parse();
    }

    /**
     * @api
     *
     * Retrieves one of the program's groups.
     *
     * @param string $groupID The group ID (`grp_…`)
     * @param string $id GrowSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(string $groupID, string $id, RequestOptions|array|null $requestOptions = null): RewardGroup
    {
        return $this->raw->retrieve($groupID, $id, $requestOptions)->parse();
    }

    /**
     * @api
     *
     * Renames, reorders, or changes the rules of a group. Sending `rules` replaces the whole list. An added `PARTICIPANT` rule moves that participant in now; a removed one moves them back to Default if they are still in this group. Email and domain rule changes move no one. To change the group's rewards, update its Campaign Rewards. Group names must be unique in the program, ignoring case. A name that another group uses returns `409`, and "Default" returns `400`.
     *
     * @param string $groupID The group ID (`grp_…`)
     * @param string $id GrowSurf program ID
     * @param RewardGroupUpdateBody $params
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(string $groupID, string $id, array $params, RequestOptions|array|null $requestOptions = null): RewardGroup
    {
        return $this->raw->update($groupID, $id, $params, $requestOptions)->parse();
    }

    /**
     * @api
     *
     * Deletes a group. Its members move to Default, and its Campaign Rewards are removed from the program, so they no longer appear in `GET /campaign/{id}/reward-configs`. Rewards already earned keep their amounts and can still be sent.
     *
     * @param string $groupID The group ID (`grp_…`)
     * @param string $id GrowSurf program ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(string $groupID, string $id, RequestOptions|array|null $requestOptions = null): DeleteRewardGroupResponse
    {
        return $this->raw->delete($groupID, $id, $requestOptions)->parse();
    }
}
