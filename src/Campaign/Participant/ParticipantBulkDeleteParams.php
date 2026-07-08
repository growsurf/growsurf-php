<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Deletes a list of participants from a program in one request. Each entry in `participants` is a GrowSurf participant ID or an email address (mixed lists are allowed). Up to `200` entries per request — chunk larger lists across multiple calls. The response reports a per-row `status` for every submitted entry, so a `200` can include rows that were `NOT_FOUND` or failed. Deletion is permanent and removes the participants' referrals, rewards, commissions, and payout records.
 *
 * @see Growsurf\Services\Campaign\ParticipantService::bulkDelete()
 *
 * @phpstan-type ParticipantBulkDeleteParamsShape = array{
 *   participants: list<string>
 * }
 */
final class ParticipantBulkDeleteParams implements BaseModel
{
    /** @use SdkModel<ParticipantBulkDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * GrowSurf participant IDs and/or email addresses to delete. Mixed entries are allowed.
     *
     * @var list<string> $participants
     */
    #[Required(list: 'string')]
    public array $participants;

    /**
     * `new ParticipantBulkDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantBulkDeleteParams::with(participants: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantBulkDeleteParams)->withParticipants(...)
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
     * @param list<string> $participants
     */
    public static function with(array $participants): self
    {
        $self = new self;

        $self['participants'] = $participants;

        return $self;
    }

    /**
     * GrowSurf participant IDs and/or email addresses to delete. Mixed entries are allowed.
     *
     * @param list<string> $participants
     */
    public function withParticipants(array $participants): self
    {
        $self = clone $this;
        $self['participants'] = $participants;

        return $self;
    }
}
