<?php

namespace Tests\Services\Campaign;

use Growsurf\Campaign\Participant\Participant;
use Growsurf\Campaign\Participant\ParticipantDeleteResponse;
use Growsurf\Campaign\Participant\ParticipantListRewardsResponse;
use Growsurf\Campaign\Participant\ParticipantSendInvitesResponse;
use Growsurf\Campaign\Participant\ParticipantTriggerReferralResponse;
use Growsurf\Campaign\Participant\ReferralStatus;
use Growsurf\Campaign\ParticipantCommissionList;
use Growsurf\Campaign\ParticipantPayoutList;
use Growsurf\Campaign\ReferralList;
use Growsurf\Client;
use Growsurf\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class ParticipantTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->participant->retrieve(
            'participantIdOrEmail',
            id: 'id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Participant::class, $result);
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->participant->retrieve(
            'participantIdOrEmail',
            id: 'id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Participant::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->participant->update(
            'participantIdOrEmail',
            id: 'id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Participant::class, $result);
    }

    #[Test]
    public function testUpdateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->participant->update(
            'participantIdOrEmail',
            id: 'id',
            email: 'dev@stainless.com',
            firstName: 'Gavin',
            lastName: 'Belson',
            metadata: ['company' => 'bar'],
            referralStatus: 'CREDIT_PENDING',
            referredBy: 'referredBy',
            unsubscribed: false,
            vanityKeys: ['_1k--w2KifJ1'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Participant::class, $result);
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->participant->delete(
            'participantIdOrEmail',
            id: 'id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ParticipantDeleteResponse::class, $result);
    }

    #[Test]
    public function testDeleteWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->participant->delete(
            'participantIdOrEmail',
            id: 'id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ParticipantDeleteResponse::class, $result);
    }

    #[Test]
    public function testAdd(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->participant->add(
            'id',
            email: 'dev@stainless.com'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Participant::class, $result);
    }

    #[Test]
    public function testAddWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->participant->add(
            'id',
            email: 'dev@stainless.com',
            fingerprint: 'fingerprint',
            firstName: 'firstName',
            ipAddress: 'ipAddress',
            lastName: 'lastName',
            metadata: ['foo' => 'bar'],
            referralStatus: 'CREDIT_PENDING',
            referredBy: 'referredBy',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Participant::class, $result);
    }

    #[Test]
    public function testListCommissions(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->participant->listCommissions(
            'participantIdOrEmail',
            id: 'id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ParticipantCommissionList::class, $result);
    }

    #[Test]
    public function testListCommissionsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->participant->listCommissions(
            'participantIdOrEmail',
            id: 'id',
            limit: 1,
            nextID: 'nextId',
            status: 'PENDING',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ParticipantCommissionList::class, $result);
    }

    #[Test]
    public function testListPayouts(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->participant->listPayouts(
            'participantIdOrEmail',
            id: 'id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ParticipantPayoutList::class, $result);
    }

    #[Test]
    public function testListPayoutsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->participant->listPayouts(
            'participantIdOrEmail',
            id: 'id',
            limit: 1,
            nextID: 'nextId',
            status: 'UPCOMING',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ParticipantPayoutList::class, $result);
    }

    #[Test]
    public function testListReferrals(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->participant->listReferrals(
            'participantIdOrEmail',
            id: 'id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ReferralList::class, $result);
    }

    #[Test]
    public function testListReferralsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->participant->listReferrals(
            'participantIdOrEmail',
            id: 'id',
            desc: true,
            email: 'email',
            firstName: 'firstName',
            lastName: 'lastName',
            limit: 1,
            nextID: 'nextId',
            offset: 0,
            referralStatus: ReferralStatus::CREDIT_PENDING,
            sortBy: 'updatedAt',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ReferralList::class, $result);
    }

    #[Test]
    public function testListRewards(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->participant->listRewards(
            'participantIdOrEmail',
            id: 'id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ParticipantListRewardsResponse::class, $result);
    }

    #[Test]
    public function testListRewardsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->participant->listRewards(
            'participantIdOrEmail',
            id: 'id',
            limit: 1,
            nextID: 'nextId'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ParticipantListRewardsResponse::class, $result);
    }

    #[Test]
    public function testRecordTransaction(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->participant->recordTransaction(
            'participantIdOrEmail',
            id: 'id',
            currency: 'USD',
            grossAmount: 9900
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }

    #[Test]
    public function testRecordTransactionWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->participant->recordTransaction(
            'participantIdOrEmail',
            id: 'id',
            currency: 'USD',
            grossAmount: 9900,
            amountCashNet: 7900,
            amountPaid: 0,
            chargeID: 'chargeId',
            customerID: 'customerId',
            description: 'Renewal for Pro subscription',
            externalID: 'externalId',
            invoiceID: 'invoice_54',
            invoiceSubtotalExcludingTax: 0,
            invoiceTotal: 0,
            invoiceTotalExcludingTax: 0,
            netAmount: 0,
            orderID: 'orderId',
            paidAt: 1733702400000,
            paymentID: 'paymentId',
            paymentIntentID: 'paymentIntentId',
            subscriptionID: 'subscriptionId',
            taxAmount: 0,
            totalTaxAmount: 0,
            totalTaxAmounts: [['foo' => 'bar']],
            totalTaxes: [['foo' => 'bar']],
            transactionID: 'transactionId',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }

    #[Test]
    public function testSendInvites(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->participant->sendInvites(
            'participantIdOrEmail',
            id: 'id',
            emailAddresses: ['erlich@aviato.com'],
            messageText: '{{referrerFirstName}} invited you with {{referrerShareUrl}}.',
            subjectText: 'Join me on Pied Piper',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ParticipantSendInvitesResponse::class, $result);
    }

    #[Test]
    public function testSendInvitesWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->participant->sendInvites(
            'participantIdOrEmail',
            id: 'id',
            emailAddresses: ['erlich@aviato.com'],
            messageText: '{{referrerFirstName}} invited you with {{referrerShareUrl}}.',
            subjectText: 'Join me on Pied Piper',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ParticipantSendInvitesResponse::class, $result);
    }

    #[Test]
    public function testTriggerReferral(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->participant->triggerReferral(
            'participantIdOrEmail',
            id: 'id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ParticipantTriggerReferralResponse::class, $result);
    }

    #[Test]
    public function testTriggerReferralWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->campaign->participant->triggerReferral(
            'participantIdOrEmail',
            id: 'id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ParticipantTriggerReferralResponse::class, $result);
    }
}
