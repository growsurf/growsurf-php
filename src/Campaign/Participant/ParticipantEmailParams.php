<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Concerns\SdkParams;
use Growsurf\Core\Contracts\BaseModel;

/**
 * Sends an email to a participant. Provide EITHER `emailType` to trigger one of the program's configured email templates, OR `subject` + `body` for a free-form email.
 *
 * @see Growsurf\Services\Campaign\ParticipantService::email()
 *
 * @phpstan-type ParticipantEmailParamsShape = array{
 *   id: string,
 *   body?: string|null,
 *   emailType?: string|null,
 *   preheader?: string|null,
 *   subject?: string|null,
 * }
 */
final class ParticipantEmailParams implements BaseModel
{
    /** @use SdkModel<ParticipantEmailParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * HTML body for a free-form email. You can personalize it with dynamic text, inserting `{{...}}` tokens like `{{firstName}}` or `{{shareUrl}}`. See [Guide to using dynamic text in GrowSurf emails](https://support.growsurf.com/article/213-guide-to-using-dynamic-text-in-growsurf-emails).
     */
    #[Optional]
    public ?string $body;

    /**
     * The program email template to trigger (template mode). Send the camelCase email-type key; the available types depend on the program type, and `isEnabled` only controls automatic sends. System/transactional types (login link, PayPal confirmation, tax) and the invite email cannot be sent. Referral programs: welcomeNonReferred, referralLinkViewedFirstTime, referralLinkUsed, referredSignup, welcomeReferred, goalAchieved, campaignEndedWinners, campaignEndedNonWinners, progressUpdateMonthly. Affiliate programs: welcomeNonReferred, referralLinkViewedFirstTime, referredSignup, commissionGenerated, commissionAdjusted, payoutPending, payoutSentSuccess, progressUpdateMonthly.
     */
    #[Optional]
    public ?string $emailType;

    /**
     * Optional preheader text for a free-form email.
     */
    #[Optional]
    public ?string $preheader;

    /**
     * Subject line for a free-form email. Supports dynamic text (`{{...}}` tokens), the same as the body.
     */
    #[Optional]
    public ?string $subject;

    /**
     * `new ParticipantEmailParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ParticipantEmailParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ParticipantEmailParams)->withID(...)
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
    public static function with(
        string $id,
        ?string $body = null,
        ?string $emailType = null,
        ?string $preheader = null,
        ?string $subject = null,
    ): self {
        $self = new self;

        $self['id'] = $id;

        null !== $body && $self['body'] = $body;
        null !== $emailType && $self['emailType'] = $emailType;
        null !== $preheader && $self['preheader'] = $preheader;
        null !== $subject && $self['subject'] = $subject;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * HTML body for a free-form email. You can personalize it with dynamic text, inserting `{{...}}` tokens like `{{firstName}}` or `{{shareUrl}}`. See [Guide to using dynamic text in GrowSurf emails](https://support.growsurf.com/article/213-guide-to-using-dynamic-text-in-growsurf-emails).
     */
    public function withBody(string $body): self
    {
        $self = clone $this;
        $self['body'] = $body;

        return $self;
    }

    /**
     * The program email template to trigger (template mode). Send the camelCase email-type key; the available types depend on the program type, and `isEnabled` only controls automatic sends. System/transactional types (login link, PayPal confirmation, tax) and the invite email cannot be sent. Referral programs: welcomeNonReferred, referralLinkViewedFirstTime, referralLinkUsed, referredSignup, welcomeReferred, goalAchieved, campaignEndedWinners, campaignEndedNonWinners, progressUpdateMonthly. Affiliate programs: welcomeNonReferred, referralLinkViewedFirstTime, referredSignup, commissionGenerated, commissionAdjusted, payoutPending, payoutSentSuccess, progressUpdateMonthly.
     */
    public function withEmailType(string $emailType): self
    {
        $self = clone $this;
        $self['emailType'] = $emailType;

        return $self;
    }

    /**
     * Optional preheader text for a free-form email.
     */
    public function withPreheader(string $preheader): self
    {
        $self = clone $this;
        $self['preheader'] = $preheader;

        return $self;
    }

    /**
     * Subject line for a free-form email. Supports dynamic text (`{{...}}` tokens), the same as the body.
     */
    public function withSubject(string $subject): self
    {
        $self = clone $this;
        $self['subject'] = $subject;

        return $self;
    }
}
