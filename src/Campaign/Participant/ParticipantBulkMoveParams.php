<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Moves a list of participants to a group, or to Default with `groupId: null`. Each entry in `participants` is a GrowSurf participant ID or an email address (mixed lists are allowed). Up to `200` entries per request. The response reports a per-row `status` for every submitted entry, so a `200` can include rows that were `NOT_FOUND`. All found participants move together: if the move fails, no one moves. A move is a manual placement, so the group's email and domain rules do not override it later, and it removes the participant from any other group's `PARTICIPANT` rules. A move applies to new referrals only. Rewards already earned keep their amounts. An ID that is not a group in this program returns `400`.
 *
 * @see Growsurf\Services\Campaign\ParticipantService::bulkMove()
 *
 * @phpstan-type ParticipantBulkMoveParamsShape = array{
 *   participants: list<string>, groupID: string|null
 * }
 */
final class ParticipantBulkMoveParams implements BaseModel
{
    /** @use SdkModel<ParticipantBulkMoveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * GrowSurf participant IDs and/or email addresses to move. Mixed entries are allowed. 1 to 200 entries.
     *
     * @var list<string> $participants
     */
    #[Required(list: 'string')]
    public array $participants;

    /** The group to move them to (`grp_…`), or `null` for Default. */
    #[Required('groupId', nullable: true)]
    public ?string $groupID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters. `groupID` is required; pass `null` to move the participants to Default.
     *
     * @param list<string> $participants
     */
    public static function with(array $participants, ?string $groupID): self
    {
        $self = new self;

        $self['participants'] = $participants;
        $self['groupID'] = $groupID;

        return $self;
    }
}
