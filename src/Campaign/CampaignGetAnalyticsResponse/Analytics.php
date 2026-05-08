<?php

declare(strict_types=1);

namespace Growsurf\Campaign\CampaignGetAnalyticsResponse;

use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type AnalyticsShape = array{
 *   blueskyShares?: int|null,
 *   emailShares?: int|null,
 *   facebookShares?: int|null,
 *   impressions?: int|null,
 *   invites?: int|null,
 *   linkedInShares?: int|null,
 *   messengerShares?: int|null,
 *   participants?: int|null,
 *   pinterestShares?: int|null,
 *   qrcodeShares?: int|null,
 *   redditShares?: int|null,
 *   referralCreditExpireds?: int|null,
 *   referralCreditPendings?: int|null,
 *   referrals?: int|null,
 *   smsShares?: int|null,
 *   telegramShares?: int|null,
 *   threadsShares?: int|null,
 *   totalCommissionCount?: int|null,
 *   totalCommissions?: int|null,
 *   totalRevenue?: int|null,
 *   tumblrShares?: int|null,
 *   twitterShares?: int|null,
 *   uniqueImpressions?: int|null,
 *   wechatShares?: int|null,
 *   whatsAppShares?: int|null,
 * }
 */
final class Analytics implements BaseModel
{
    /** @use SdkModel<AnalyticsShape> */
    use SdkModel;

    #[Optional]
    public ?int $blueskyShares;

    #[Optional]
    public ?int $emailShares;

    #[Optional]
    public ?int $facebookShares;

    #[Optional]
    public ?int $impressions;

    #[Optional]
    public ?int $invites;

    #[Optional]
    public ?int $linkedInShares;

    #[Optional]
    public ?int $messengerShares;

    #[Optional]
    public ?int $participants;

    #[Optional]
    public ?int $pinterestShares;

    #[Optional]
    public ?int $qrcodeShares;

    #[Optional]
    public ?int $redditShares;

    #[Optional]
    public ?int $referralCreditExpireds;

    #[Optional]
    public ?int $referralCreditPendings;

    #[Optional]
    public ?int $referrals;

    #[Optional]
    public ?int $smsShares;

    #[Optional]
    public ?int $telegramShares;

    #[Optional]
    public ?int $threadsShares;

    /**
     * Affiliate programs only. Number of commission records.
     */
    #[Optional]
    public ?int $totalCommissionCount;

    /**
     * Affiliate programs only. Commissions in the smallest unit of the program currency.
     */
    #[Optional]
    public ?int $totalCommissions;

    /**
     * Affiliate programs only. Revenue in the smallest unit of the program currency.
     */
    #[Optional]
    public ?int $totalRevenue;

    #[Optional]
    public ?int $tumblrShares;

    #[Optional]
    public ?int $twitterShares;

    #[Optional]
    public ?int $uniqueImpressions;

    #[Optional]
    public ?int $wechatShares;

    #[Optional]
    public ?int $whatsAppShares;

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
        ?int $blueskyShares = null,
        ?int $emailShares = null,
        ?int $facebookShares = null,
        ?int $impressions = null,
        ?int $invites = null,
        ?int $linkedInShares = null,
        ?int $messengerShares = null,
        ?int $participants = null,
        ?int $pinterestShares = null,
        ?int $qrcodeShares = null,
        ?int $redditShares = null,
        ?int $referralCreditExpireds = null,
        ?int $referralCreditPendings = null,
        ?int $referrals = null,
        ?int $smsShares = null,
        ?int $telegramShares = null,
        ?int $threadsShares = null,
        ?int $totalCommissionCount = null,
        ?int $totalCommissions = null,
        ?int $totalRevenue = null,
        ?int $tumblrShares = null,
        ?int $twitterShares = null,
        ?int $uniqueImpressions = null,
        ?int $wechatShares = null,
        ?int $whatsAppShares = null,
    ): self {
        $self = new self;

        null !== $blueskyShares && $self['blueskyShares'] = $blueskyShares;
        null !== $emailShares && $self['emailShares'] = $emailShares;
        null !== $facebookShares && $self['facebookShares'] = $facebookShares;
        null !== $impressions && $self['impressions'] = $impressions;
        null !== $invites && $self['invites'] = $invites;
        null !== $linkedInShares && $self['linkedInShares'] = $linkedInShares;
        null !== $messengerShares && $self['messengerShares'] = $messengerShares;
        null !== $participants && $self['participants'] = $participants;
        null !== $pinterestShares && $self['pinterestShares'] = $pinterestShares;
        null !== $qrcodeShares && $self['qrcodeShares'] = $qrcodeShares;
        null !== $redditShares && $self['redditShares'] = $redditShares;
        null !== $referralCreditExpireds && $self['referralCreditExpireds'] = $referralCreditExpireds;
        null !== $referralCreditPendings && $self['referralCreditPendings'] = $referralCreditPendings;
        null !== $referrals && $self['referrals'] = $referrals;
        null !== $smsShares && $self['smsShares'] = $smsShares;
        null !== $telegramShares && $self['telegramShares'] = $telegramShares;
        null !== $threadsShares && $self['threadsShares'] = $threadsShares;
        null !== $totalCommissionCount && $self['totalCommissionCount'] = $totalCommissionCount;
        null !== $totalCommissions && $self['totalCommissions'] = $totalCommissions;
        null !== $totalRevenue && $self['totalRevenue'] = $totalRevenue;
        null !== $tumblrShares && $self['tumblrShares'] = $tumblrShares;
        null !== $twitterShares && $self['twitterShares'] = $twitterShares;
        null !== $uniqueImpressions && $self['uniqueImpressions'] = $uniqueImpressions;
        null !== $wechatShares && $self['wechatShares'] = $wechatShares;
        null !== $whatsAppShares && $self['whatsAppShares'] = $whatsAppShares;

        return $self;
    }

    public function withBlueskyShares(int $blueskyShares): self
    {
        $self = clone $this;
        $self['blueskyShares'] = $blueskyShares;

        return $self;
    }

    public function withEmailShares(int $emailShares): self
    {
        $self = clone $this;
        $self['emailShares'] = $emailShares;

        return $self;
    }

    public function withFacebookShares(int $facebookShares): self
    {
        $self = clone $this;
        $self['facebookShares'] = $facebookShares;

        return $self;
    }

    public function withImpressions(int $impressions): self
    {
        $self = clone $this;
        $self['impressions'] = $impressions;

        return $self;
    }

    public function withInvites(int $invites): self
    {
        $self = clone $this;
        $self['invites'] = $invites;

        return $self;
    }

    public function withLinkedInShares(int $linkedInShares): self
    {
        $self = clone $this;
        $self['linkedInShares'] = $linkedInShares;

        return $self;
    }

    public function withMessengerShares(int $messengerShares): self
    {
        $self = clone $this;
        $self['messengerShares'] = $messengerShares;

        return $self;
    }

    public function withParticipants(int $participants): self
    {
        $self = clone $this;
        $self['participants'] = $participants;

        return $self;
    }

    public function withPinterestShares(int $pinterestShares): self
    {
        $self = clone $this;
        $self['pinterestShares'] = $pinterestShares;

        return $self;
    }

    public function withQrcodeShares(int $qrcodeShares): self
    {
        $self = clone $this;
        $self['qrcodeShares'] = $qrcodeShares;

        return $self;
    }

    public function withRedditShares(int $redditShares): self
    {
        $self = clone $this;
        $self['redditShares'] = $redditShares;

        return $self;
    }

    public function withReferralCreditExpireds(
        int $referralCreditExpireds
    ): self {
        $self = clone $this;
        $self['referralCreditExpireds'] = $referralCreditExpireds;

        return $self;
    }

    public function withReferralCreditPendings(
        int $referralCreditPendings
    ): self {
        $self = clone $this;
        $self['referralCreditPendings'] = $referralCreditPendings;

        return $self;
    }

    public function withReferrals(int $referrals): self
    {
        $self = clone $this;
        $self['referrals'] = $referrals;

        return $self;
    }

    public function withSMSShares(int $smsShares): self
    {
        $self = clone $this;
        $self['smsShares'] = $smsShares;

        return $self;
    }

    public function withTelegramShares(int $telegramShares): self
    {
        $self = clone $this;
        $self['telegramShares'] = $telegramShares;

        return $self;
    }

    public function withThreadsShares(int $threadsShares): self
    {
        $self = clone $this;
        $self['threadsShares'] = $threadsShares;

        return $self;
    }

    /**
     * Affiliate programs only. Number of commission records.
     */
    public function withTotalCommissionCount(int $totalCommissionCount): self
    {
        $self = clone $this;
        $self['totalCommissionCount'] = $totalCommissionCount;

        return $self;
    }

    /**
     * Affiliate programs only. Commissions in the smallest unit of the program currency.
     */
    public function withTotalCommissions(int $totalCommissions): self
    {
        $self = clone $this;
        $self['totalCommissions'] = $totalCommissions;

        return $self;
    }

    /**
     * Affiliate programs only. Revenue in the smallest unit of the program currency.
     */
    public function withTotalRevenue(int $totalRevenue): self
    {
        $self = clone $this;
        $self['totalRevenue'] = $totalRevenue;

        return $self;
    }

    public function withTumblrShares(int $tumblrShares): self
    {
        $self = clone $this;
        $self['tumblrShares'] = $tumblrShares;

        return $self;
    }

    public function withTwitterShares(int $twitterShares): self
    {
        $self = clone $this;
        $self['twitterShares'] = $twitterShares;

        return $self;
    }

    public function withUniqueImpressions(int $uniqueImpressions): self
    {
        $self = clone $this;
        $self['uniqueImpressions'] = $uniqueImpressions;

        return $self;
    }

    public function withWechatShares(int $wechatShares): self
    {
        $self = clone $this;
        $self['wechatShares'] = $wechatShares;

        return $self;
    }

    public function withWhatsAppShares(int $whatsAppShares): self
    {
        $self = clone $this;
        $self['whatsAppShares'] = $whatsAppShares;

        return $self;
    }
}
