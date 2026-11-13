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
     * Creates a group with a copy of each active Default reward, except Leaderboard rewards, which stay program-wide. The copies have new IDs and this group's `groupId`; change them with Update a campaign reward. `rules` place participants in the group: `EMAIL` matches an exact email, `DOMAIN` matches a company domain (public email domains such as gmail.com are refused), and `PARTICIPANT` moves an existing participant in now. Each email and domain can be in one group only. Email and domain rules place new signups and affiliate approvals only; they do not move existing participants. When more than one way matches, a move (a `PARTICIPANT` rule, Update participant, or bulk move) wins, then the group's signup link, then `EMAIL`, then `DOMAIN`, then Default. Group names must be unique in the program, ignoring case. A name that another group uses returns `409`, and "Default" returns `400`.
     *
     * @param string $id GrowSurf program ID
     * @param string $name The group name (internal only, never shown to participants). 1 to 100 characters.
     * @param list<RewardGroupRule|RewardGroupRuleShape>|null $rules The rules that place participants in this group. Each email and domain can be in one group only. Up to 500.
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
