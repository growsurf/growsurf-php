<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Campaign\Participant\Participant\Referrer;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;
use Growsurf\Core\Conversion\MapOf;

/**
 * @phpstan-import-type ParticipantRewardShape from \Growsurf\Campaign\Participant\ParticipantReward
 * @phpstan-import-type ReferrerShape from \Growsurf\Campaign\Participant\Participant\Referrer
 *
 * @phpstan-type ParticipantShape = array{
 *   id: string,
 *   email: string,
 *   monthlyRank: int,
 *   monthlyReferralCount: int,
 *   rank: int,
 *   referralCount: int,
 *   rewards: list<ParticipantReward|ParticipantRewardShape>,
 *   shareURL: string,
 *   allMatchingFraudsters?: list<array<string,mixed>>|null,
 *   createdAt?: int|null,
 *   fingerprint?: string|null,
 *   firstName?: string|null,
 *   fraudReasonCode?: string|null,
 *   fraudRiskLevel?: null|FraudRiskLevel|value-of<FraudRiskLevel>,
 *   impressionCount?: int|null,
 *   inviteCount?: int|null,
 *   ipAddress?: string|null,
 *   isNew?: bool|null,
 *   isWinner?: bool|null,
 *   lastName?: string|null,
 *   metadata?: array<string,mixed>|null,
 *   monthlyReferrals?: list<string>|null,
 *   notes?: string|null,
 *   paypalEmailAddress?: string|null,
 *   prevMonthlyRank?: int|null,
 *   prevMonthlyReferralCount?: int|null,
 *   referrals?: list<string>|null,
 *   referralSource?: null|ReferralSource|value-of<ReferralSource>,
 *   referralStatus?: null|ReferralStatus|value-of<ReferralStatus>,
 *   referredBy?: string|null,
 *   referrer?: null|Referrer|ReferrerShape,
 *   shareCount?: array<string,int>|null,
 *   uniqueImpressionCount?: int|null,
 *   unreadCommissionsCount?: int|null,
 *   unreadPayoutsCount?: int|null,
 *   unsubscribed?: bool|null,
 *   vanityKeys?: list<string>|null,
 * }
 */
final class Participant implements BaseModel
{
    /** @use SdkModel<ParticipantShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required]
    public string $email;

    #[Required]
    public int $monthlyRank;

    #[Required]
    public int $monthlyReferralCount;

    #[Required]
    public int $rank;

    #[Required]
    public int $referralCount;

    /** @var list<ParticipantReward> $rewards */
    #[Required(list: ParticipantReward::class)]
    public array $rewards;

    #[Required('shareUrl')]
    public string $shareURL;

    /** @var list<array<string,mixed>>|null $allMatchingFraudsters */
    #[Optional(list: new MapOf('mixed'))]
    public ?array $allMatchingFraudsters;

    #[Optional]
    public ?int $createdAt;

    #[Optional(nullable: true)]
    public ?string $fingerprint;

    #[Optional(nullable: true)]
    public ?string $firstName;

    #[Optional]
    public ?string $fraudReasonCode;

    /** @var value-of<FraudRiskLevel>|null $fraudRiskLevel */
    #[Optional(enum: FraudRiskLevel::class)]
    public ?string $fraudRiskLevel;

    #[Optional]
    public ?int $impressionCount;

    #[Optional]
    public ?int $inviteCount;

    #[Optional(nullable: true)]
    public ?string $ipAddress;

    #[Optional]
    public ?bool $isNew;

    #[Optional]
    public ?bool $isWinner;

    #[Optional(nullable: true)]
    public ?string $lastName;

    /**
     * Shallow custom metadata object.
     *
     * @var array<string,mixed>|null $metadata
     */
    #[Optional(map: 'mixed')]
    public ?array $metadata;

    /** @var list<string>|null $monthlyReferrals */
    #[Optional(list: 'string')]
    public ?array $monthlyReferrals;

    #[Optional(nullable: true)]
    public ?string $notes;

    #[Optional]
    public ?string $paypalEmailAddress;

    #[Optional]
    public ?int $prevMonthlyRank;

    #[Optional]
    public ?int $prevMonthlyReferralCount;

    /** @var list<string>|null $referrals */
    #[Optional(list: 'string')]
    public ?array $referrals;

    /** @var value-of<ReferralSource>|null $referralSource */
    #[Optional(enum: ReferralSource::class)]
    public ?string $referralSource;

    /** @var value-of<ReferralStatus>|null $referralStatus */
    #[Optional(enum: ReferralStatus::class)]
    public ?string $referralStatus;

    #[Optional]
    public ?string $referredBy;

    #[Optional(nullable: true)]
    public ?Referrer $referrer;

    /** @var array<string,int>|null $shareCount */
    #[Optional(map: 'int')]
    public ?array $shareCount;

    #[Optional]
    public ?int $uniqueImpressionCount;

    #[Optional]
    public ?int $unreadCommissionsCount;

    #[Optional]
    public ?int $unreadPayoutsCount;

    #[Optional]
    public ?bool $unsubscribed;

    /** @var list<string>|null $vanityKeys */
    #[Optional(list: 'string')]
    public ?array $vanityKeys;

    /**
     * `new Participant()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Participant::with(
     *   id: ...,
     *   email: ...,
     *   monthlyRank: ...,
     *   monthlyReferralCount: ...,
     *   rank: ...,
     *   referralCount: ...,
     *   rewards: ...,
     *   shareURL: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Participant)
     *   ->withID(...)
     *   ->withEmail(...)
     *   ->withMonthlyRank(...)
     *   ->withMonthlyReferralCount(...)
     *   ->withRank(...)
     *   ->withReferralCount(...)
     *   ->withRewards(...)
     *   ->withShareURL(...)
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
     * @param list<ParticipantReward|ParticipantRewardShape> $rewards
     * @param list<array<string,mixed>>|null $allMatchingFraudsters
     * @param FraudRiskLevel|value-of<FraudRiskLevel>|null $fraudRiskLevel
     * @param array<string,mixed>|null $metadata
     * @param list<string>|null $monthlyReferrals
     * @param list<string>|null $referrals
     * @param ReferralSource|value-of<ReferralSource>|null $referralSource
     * @param ReferralStatus|value-of<ReferralStatus>|null $referralStatus
     * @param Referrer|ReferrerShape|null $referrer
     * @param array<string,int>|null $shareCount
     * @param list<string>|null $vanityKeys
     */
    public static function with(
        string $id,
        string $email,
        int $monthlyRank,
        int $monthlyReferralCount,
        int $rank,
        int $referralCount,
        array $rewards,
        string $shareURL,
        ?array $allMatchingFraudsters = null,
        ?int $createdAt = null,
        ?string $fingerprint = null,
        ?string $firstName = null,
        ?string $fraudReasonCode = null,
        FraudRiskLevel|string|null $fraudRiskLevel = null,
        ?int $impressionCount = null,
        ?int $inviteCount = null,
        ?string $ipAddress = null,
        ?bool $isNew = null,
        ?bool $isWinner = null,
        ?string $lastName = null,
        ?array $metadata = null,
        ?array $monthlyReferrals = null,
        ?string $notes = null,
        ?string $paypalEmailAddress = null,
        ?int $prevMonthlyRank = null,
        ?int $prevMonthlyReferralCount = null,
        ?array $referrals = null,
        ReferralSource|string|null $referralSource = null,
        ReferralStatus|string|null $referralStatus = null,
        ?string $referredBy = null,
        Referrer|array|null $referrer = null,
        ?array $shareCount = null,
        ?int $uniqueImpressionCount = null,
        ?int $unreadCommissionsCount = null,
        ?int $unreadPayoutsCount = null,
        ?bool $unsubscribed = null,
        ?array $vanityKeys = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['email'] = $email;
        $self['monthlyRank'] = $monthlyRank;
        $self['monthlyReferralCount'] = $monthlyReferralCount;
        $self['rank'] = $rank;
        $self['referralCount'] = $referralCount;
        $self['rewards'] = $rewards;
        $self['shareURL'] = $shareURL;

        null !== $allMatchingFraudsters && $self['allMatchingFraudsters'] = $allMatchingFraudsters;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $fingerprint && $self['fingerprint'] = $fingerprint;
        null !== $firstName && $self['firstName'] = $firstName;
        null !== $fraudReasonCode && $self['fraudReasonCode'] = $fraudReasonCode;
        null !== $fraudRiskLevel && $self['fraudRiskLevel'] = $fraudRiskLevel;
        null !== $impressionCount && $self['impressionCount'] = $impressionCount;
        null !== $inviteCount && $self['inviteCount'] = $inviteCount;
        null !== $ipAddress && $self['ipAddress'] = $ipAddress;
        null !== $isNew && $self['isNew'] = $isNew;
        null !== $isWinner && $self['isWinner'] = $isWinner;
        null !== $lastName && $self['lastName'] = $lastName;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $monthlyReferrals && $self['monthlyReferrals'] = $monthlyReferrals;
        null !== $notes && $self['notes'] = $notes;
        null !== $paypalEmailAddress && $self['paypalEmailAddress'] = $paypalEmailAddress;
        null !== $prevMonthlyRank && $self['prevMonthlyRank'] = $prevMonthlyRank;
        null !== $prevMonthlyReferralCount && $self['prevMonthlyReferralCount'] = $prevMonthlyReferralCount;
        null !== $referrals && $self['referrals'] = $referrals;
        null !== $referralSource && $self['referralSource'] = $referralSource;
        null !== $referralStatus && $self['referralStatus'] = $referralStatus;
        null !== $referredBy && $self['referredBy'] = $referredBy;
        null !== $referrer && $self['referrer'] = $referrer;
        null !== $shareCount && $self['shareCount'] = $shareCount;
        null !== $uniqueImpressionCount && $self['uniqueImpressionCount'] = $uniqueImpressionCount;
        null !== $unreadCommissionsCount && $self['unreadCommissionsCount'] = $unreadCommissionsCount;
        null !== $unreadPayoutsCount && $self['unreadPayoutsCount'] = $unreadPayoutsCount;
        null !== $unsubscribed && $self['unsubscribed'] = $unsubscribed;
        null !== $vanityKeys && $self['vanityKeys'] = $vanityKeys;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    public function withMonthlyRank(int $monthlyRank): self
    {
        $self = clone $this;
        $self['monthlyRank'] = $monthlyRank;

        return $self;
    }

    public function withMonthlyReferralCount(int $monthlyReferralCount): self
    {
        $self = clone $this;
        $self['monthlyReferralCount'] = $monthlyReferralCount;

        return $self;
    }

    public function withRank(int $rank): self
    {
        $self = clone $this;
        $self['rank'] = $rank;

        return $self;
    }

    public function withReferralCount(int $referralCount): self
    {
        $self = clone $this;
        $self['referralCount'] = $referralCount;

        return $self;
    }

    /**
     * @param list<ParticipantReward|ParticipantRewardShape> $rewards
     */
    public function withRewards(array $rewards): self
    {
        $self = clone $this;
        $self['rewards'] = $rewards;

        return $self;
    }

    public function withShareURL(string $shareURL): self
    {
        $self = clone $this;
        $self['shareURL'] = $shareURL;

        return $self;
    }

    /**
     * @param list<array<string,mixed>> $allMatchingFraudsters
     */
    public function withAllMatchingFraudsters(
        array $allMatchingFraudsters
    ): self {
        $self = clone $this;
        $self['allMatchingFraudsters'] = $allMatchingFraudsters;

        return $self;
    }

    public function withCreatedAt(int $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withFingerprint(?string $fingerprint): self
    {
        $self = clone $this;
        $self['fingerprint'] = $fingerprint;

        return $self;
    }

    public function withFirstName(?string $firstName): self
    {
        $self = clone $this;
        $self['firstName'] = $firstName;

        return $self;
    }

    public function withFraudReasonCode(string $fraudReasonCode): self
    {
        $self = clone $this;
        $self['fraudReasonCode'] = $fraudReasonCode;

        return $self;
    }

    /**
     * @param FraudRiskLevel|value-of<FraudRiskLevel> $fraudRiskLevel
     */
    public function withFraudRiskLevel(
        FraudRiskLevel|string $fraudRiskLevel
    ): self {
        $self = clone $this;
        $self['fraudRiskLevel'] = $fraudRiskLevel;

        return $self;
    }

    public function withImpressionCount(int $impressionCount): self
    {
        $self = clone $this;
        $self['impressionCount'] = $impressionCount;

        return $self;
    }

    public function withInviteCount(int $inviteCount): self
    {
        $self = clone $this;
        $self['inviteCount'] = $inviteCount;

        return $self;
    }

    public function withIPAddress(?string $ipAddress): self
    {
        $self = clone $this;
        $self['ipAddress'] = $ipAddress;

        return $self;
    }

    public function withIsNew(bool $isNew): self
    {
        $self = clone $this;
        $self['isNew'] = $isNew;

        return $self;
    }

    public function withIsWinner(bool $isWinner): self
    {
        $self = clone $this;
        $self['isWinner'] = $isWinner;

        return $self;
    }

    public function withLastName(?string $lastName): self
    {
        $self = clone $this;
        $self['lastName'] = $lastName;

        return $self;
    }

    /**
     * Shallow custom metadata object.
     *
     * @param array<string,mixed> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * @param list<string> $monthlyReferrals
     */
    public function withMonthlyReferrals(array $monthlyReferrals): self
    {
        $self = clone $this;
        $self['monthlyReferrals'] = $monthlyReferrals;

        return $self;
    }

    public function withNotes(?string $notes): self
    {
        $self = clone $this;
        $self['notes'] = $notes;

        return $self;
    }

    public function withPaypalEmailAddress(string $paypalEmailAddress): self
    {
        $self = clone $this;
        $self['paypalEmailAddress'] = $paypalEmailAddress;

        return $self;
    }

    public function withPrevMonthlyRank(int $prevMonthlyRank): self
    {
        $self = clone $this;
        $self['prevMonthlyRank'] = $prevMonthlyRank;

        return $self;
    }

    public function withPrevMonthlyReferralCount(
        int $prevMonthlyReferralCount
    ): self {
        $self = clone $this;
        $self['prevMonthlyReferralCount'] = $prevMonthlyReferralCount;

        return $self;
    }

    /**
     * @param list<string> $referrals
     */
    public function withReferrals(array $referrals): self
    {
        $self = clone $this;
        $self['referrals'] = $referrals;

        return $self;
    }

    /**
     * @param ReferralSource|value-of<ReferralSource> $referralSource
     */
    public function withReferralSource(
        ReferralSource|string $referralSource
    ): self {
        $self = clone $this;
        $self['referralSource'] = $referralSource;

        return $self;
    }

    /**
     * @param ReferralStatus|value-of<ReferralStatus> $referralStatus
     */
    public function withReferralStatus(
        ReferralStatus|string $referralStatus
    ): self {
        $self = clone $this;
        $self['referralStatus'] = $referralStatus;

        return $self;
    }

    public function withReferredBy(string $referredBy): self
    {
        $self = clone $this;
        $self['referredBy'] = $referredBy;

        return $self;
    }

    /**
     * @param Referrer|ReferrerShape|null $referrer
     */
    public function withReferrer(Referrer|array|null $referrer): self
    {
        $self = clone $this;
        $self['referrer'] = $referrer;

        return $self;
    }

    /**
     * @param array<string,int> $shareCount
     */
    public function withShareCount(array $shareCount): self
    {
        $self = clone $this;
        $self['shareCount'] = $shareCount;

        return $self;
    }

    public function withUniqueImpressionCount(int $uniqueImpressionCount): self
    {
        $self = clone $this;
        $self['uniqueImpressionCount'] = $uniqueImpressionCount;

        return $self;
    }

    public function withUnreadCommissionsCount(
        int $unreadCommissionsCount
    ): self {
        $self = clone $this;
        $self['unreadCommissionsCount'] = $unreadCommissionsCount;

        return $self;
    }

    public function withUnreadPayoutsCount(int $unreadPayoutsCount): self
    {
        $self = clone $this;
        $self['unreadPayoutsCount'] = $unreadPayoutsCount;

        return $self;
    }

    public function withUnsubscribed(bool $unsubscribed): self
    {
        $self = clone $this;
        $self['unsubscribed'] = $unsubscribed;

        return $self;
    }

    /**
     * @param list<string> $vanityKeys
     */
    public function withVanityKeys(array $vanityKeys): self
    {
        $self = clone $this;
        $self['vanityKeys'] = $vanityKeys;

        return $self;
    }
}
