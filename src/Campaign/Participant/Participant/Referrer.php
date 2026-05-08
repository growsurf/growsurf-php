<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\Participant;

use Growsurf\Campaign\Participant\FraudRiskLevel;
use Growsurf\Campaign\Participant\ReferralSource;
use Growsurf\Campaign\Participant\ReferralStatus;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type ReferrerShape = array{
 *   id?: string|null,
 *   createdAt?: int|null,
 *   email?: string|null,
 *   fingerprint?: string|null,
 *   firstName?: string|null,
 *   fraudReasonCode?: string|null,
 *   fraudRiskLevel?: null|FraudRiskLevel|value-of<FraudRiskLevel>,
 *   impressionCount?: int|null,
 *   inviteCount?: int|null,
 *   ipAddress?: string|null,
 *   isWinner?: bool|null,
 *   lastName?: string|null,
 *   metadata?: array<string,mixed>|null,
 *   monthlyRank?: int|null,
 *   monthlyReferralCount?: int|null,
 *   monthlyReferrals?: list<string>|null,
 *   prevMonthlyRank?: int|null,
 *   prevMonthlyReferralCount?: int|null,
 *   rank?: int|null,
 *   referralCount?: int|null,
 *   referrals?: list<string>|null,
 *   referralSource?: null|ReferralSource|value-of<ReferralSource>,
 *   referralStatus?: null|ReferralStatus|value-of<ReferralStatus>,
 *   shareCount?: array<string,int>|null,
 *   shareURL?: string|null,
 *   uniqueImpressionCount?: int|null,
 *   unsubscribed?: bool|null,
 * }
 */
final class Referrer implements BaseModel
{
    /** @use SdkModel<ReferrerShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional]
    public ?int $createdAt;

    #[Optional]
    public ?string $email;

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

    #[Optional]
    public ?int $monthlyRank;

    #[Optional]
    public ?int $monthlyReferralCount;

    /** @var list<string>|null $monthlyReferrals */
    #[Optional(list: 'string')]
    public ?array $monthlyReferrals;

    #[Optional]
    public ?int $prevMonthlyRank;

    #[Optional]
    public ?int $prevMonthlyReferralCount;

    #[Optional]
    public ?int $rank;

    #[Optional]
    public ?int $referralCount;

    /** @var list<string>|null $referrals */
    #[Optional(list: 'string')]
    public ?array $referrals;

    /** @var value-of<ReferralSource>|null $referralSource */
    #[Optional(enum: ReferralSource::class)]
    public ?string $referralSource;

    /** @var value-of<ReferralStatus>|null $referralStatus */
    #[Optional(enum: ReferralStatus::class)]
    public ?string $referralStatus;

    /** @var array<string,int>|null $shareCount */
    #[Optional(map: 'int')]
    public ?array $shareCount;

    #[Optional('shareUrl')]
    public ?string $shareURL;

    #[Optional]
    public ?int $uniqueImpressionCount;

    #[Optional]
    public ?bool $unsubscribed;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param FraudRiskLevel|value-of<FraudRiskLevel>|null $fraudRiskLevel
     * @param array<string,mixed>|null $metadata
     * @param list<string>|null $monthlyReferrals
     * @param list<string>|null $referrals
     * @param ReferralSource|value-of<ReferralSource>|null $referralSource
     * @param ReferralStatus|value-of<ReferralStatus>|null $referralStatus
     * @param array<string,int>|null $shareCount
     */
    public static function with(
        ?string $id = null,
        ?int $createdAt = null,
        ?string $email = null,
        ?string $fingerprint = null,
        ?string $firstName = null,
        ?string $fraudReasonCode = null,
        FraudRiskLevel|string|null $fraudRiskLevel = null,
        ?int $impressionCount = null,
        ?int $inviteCount = null,
        ?string $ipAddress = null,
        ?bool $isWinner = null,
        ?string $lastName = null,
        ?array $metadata = null,
        ?int $monthlyRank = null,
        ?int $monthlyReferralCount = null,
        ?array $monthlyReferrals = null,
        ?int $prevMonthlyRank = null,
        ?int $prevMonthlyReferralCount = null,
        ?int $rank = null,
        ?int $referralCount = null,
        ?array $referrals = null,
        ReferralSource|string|null $referralSource = null,
        ReferralStatus|string|null $referralStatus = null,
        ?array $shareCount = null,
        ?string $shareURL = null,
        ?int $uniqueImpressionCount = null,
        ?bool $unsubscribed = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $email && $self['email'] = $email;
        null !== $fingerprint && $self['fingerprint'] = $fingerprint;
        null !== $firstName && $self['firstName'] = $firstName;
        null !== $fraudReasonCode && $self['fraudReasonCode'] = $fraudReasonCode;
        null !== $fraudRiskLevel && $self['fraudRiskLevel'] = $fraudRiskLevel;
        null !== $impressionCount && $self['impressionCount'] = $impressionCount;
        null !== $inviteCount && $self['inviteCount'] = $inviteCount;
        null !== $ipAddress && $self['ipAddress'] = $ipAddress;
        null !== $isWinner && $self['isWinner'] = $isWinner;
        null !== $lastName && $self['lastName'] = $lastName;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $monthlyRank && $self['monthlyRank'] = $monthlyRank;
        null !== $monthlyReferralCount && $self['monthlyReferralCount'] = $monthlyReferralCount;
        null !== $monthlyReferrals && $self['monthlyReferrals'] = $monthlyReferrals;
        null !== $prevMonthlyRank && $self['prevMonthlyRank'] = $prevMonthlyRank;
        null !== $prevMonthlyReferralCount && $self['prevMonthlyReferralCount'] = $prevMonthlyReferralCount;
        null !== $rank && $self['rank'] = $rank;
        null !== $referralCount && $self['referralCount'] = $referralCount;
        null !== $referrals && $self['referrals'] = $referrals;
        null !== $referralSource && $self['referralSource'] = $referralSource;
        null !== $referralStatus && $self['referralStatus'] = $referralStatus;
        null !== $shareCount && $self['shareCount'] = $shareCount;
        null !== $shareURL && $self['shareURL'] = $shareURL;
        null !== $uniqueImpressionCount && $self['uniqueImpressionCount'] = $uniqueImpressionCount;
        null !== $unsubscribed && $self['unsubscribed'] = $unsubscribed;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withCreatedAt(int $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

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

    /**
     * @param list<string> $monthlyReferrals
     */
    public function withMonthlyReferrals(array $monthlyReferrals): self
    {
        $self = clone $this;
        $self['monthlyReferrals'] = $monthlyReferrals;

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

    /**
     * @param array<string,int> $shareCount
     */
    public function withShareCount(array $shareCount): self
    {
        $self = clone $this;
        $self['shareCount'] = $shareCount;

        return $self;
    }

    public function withShareURL(string $shareURL): self
    {
        $self = clone $this;
        $self['shareURL'] = $shareURL;

        return $self;
    }

    public function withUniqueImpressionCount(int $uniqueImpressionCount): self
    {
        $self = clone $this;
        $self['uniqueImpressionCount'] = $uniqueImpressionCount;

        return $self;
    }

    public function withUnsubscribed(bool $unsubscribed): self
    {
        $self = clone $this;
        $self['unsubscribed'] = $unsubscribed;

        return $self;
    }
}
