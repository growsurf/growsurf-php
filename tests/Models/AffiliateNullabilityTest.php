<?php

declare(strict_types=1);

namespace Tests\Models;

use Growsurf\Campaign\AffiliateApplication;
use Growsurf\Campaign\AffiliateApplicationAnswer;
use Growsurf\Campaign\AffiliateApplicationAnswer\Type;
use Growsurf\Campaign\AffiliateApplication\RiskLevel;
use Growsurf\Campaign\AffiliateInvite;
use Growsurf\Core\Attributes\Optional;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Conversion;
use PHPUnit\Framework\TestCase;

final class AffiliateNullabilityTest extends TestCase
{
    public function testAffiliateApplicationHydratesAndSetsExplicitNulls(): void
    {
        $payload = [
            'id' => 'application-id',
            'answers' => [],
            'createdAt' => 1,
            'decidedAt' => null,
            'email' => null,
            'firstName' => null,
            'lastName' => null,
            'participantId' => null,
            'reapplyAllowedAt' => null,
            'rejectionReason' => null,
            'reviewedAt' => null,
            'riskLevel' => null,
            'status' => 'PENDING',
            'termsAcceptedAt' => null,
        ];

        $application = Conversion::coerce(
            AffiliateApplication::class,
            value: $payload,
        );

        self::assertInstanceOf(AffiliateApplication::class, $application);
        self::assertSame($payload, $application->jsonSerialize());

        $withNulls = AffiliateApplication::with(
            id: 'application-id',
            answers: [],
            createdAt: 1,
            decidedAt: null,
            email: null,
            firstName: null,
            lastName: null,
            participantID: null,
            reapplyAllowedAt: null,
            rejectionReason: null,
            reviewedAt: null,
            riskLevel: null,
            status: 'PENDING',
            termsAcceptedAt: null,
        );

        self::assertSame($payload, $withNulls->jsonSerialize());
        self::assertNull($withNulls->withTermsAcceptedAt(null)->termsAcceptedAt);
        $this->assertRequiredNullableMetadata(AffiliateApplication::class, [
            'decidedAt',
            'email',
            'firstName',
            'lastName',
            'participantID',
            'reapplyAllowedAt',
            'rejectionReason',
            'reviewedAt',
            'riskLevel',
            'termsAcceptedAt',
        ]);
    }

    public function testAffiliateApplicationRiskLevelUsesPublishedEnum(): void
    {
        $application = AffiliateApplication::with(
            id: 'application-id',
            answers: [],
            createdAt: 1,
            decidedAt: null,
            email: null,
            firstName: null,
            lastName: null,
            participantID: null,
            reapplyAllowedAt: null,
            rejectionReason: null,
            reviewedAt: null,
            riskLevel: RiskLevel::LOW,
            status: 'PENDING',
            termsAcceptedAt: null,
        );

        self::assertSame('LOW', $application->jsonSerialize()['riskLevel']);
    }

    public function testAffiliateApplicationAnswersUseSavedFormScalarTypes(): void
    {
        $answers = [
            AffiliateApplicationAnswer::with(
                fieldID: 'website',
                label: 'Website',
                type: Type::URL,
                value: 'https://example.com',
            ),
            AffiliateApplicationAnswer::with(
                fieldID: 'country',
                label: 'Country',
                type: Type::COUNTRY,
                value: 'US',
            ),
            AffiliateApplicationAnswer::with(
                fieldID: 'audience-size',
                label: 'Audience size',
                type: Type::NUMBER,
                value: 1000,
            ),
            AffiliateApplicationAnswer::with(
                fieldID: 'terms',
                label: 'I agree',
                type: Type::CHECKBOX,
                value: true,
            ),
        ];

        $serializedAnswers = array_map(
            static fn (AffiliateApplicationAnswer $answer): array => $answer->jsonSerialize(),
            $answers,
        );

        self::assertSame(
            ['url', 'country', 'number', 'checkbox'],
            array_column($serializedAnswers, 'type'),
        );
        self::assertSame(
            ['https://example.com', 'US', 1000, true],
            array_column($serializedAnswers, 'value'),
        );
    }

    public function testAffiliateApplicationFieldsAreRequired(): void
    {
        foreach (
            [
                'id',
                'answers',
                'createdAt',
                'decidedAt',
                'email',
                'firstName',
                'lastName',
                'participantID',
                'reapplyAllowedAt',
                'rejectionReason',
                'reviewedAt',
                'riskLevel',
                'status',
                'termsAcceptedAt',
            ] as $property
        ) {
            self::assertCount(
                1,
                (new \ReflectionProperty(AffiliateApplication::class, $property))
                    ->getAttributes(Required::class),
            );
        }

        foreach (['fieldID', 'label', 'type', 'value'] as $property) {
            self::assertCount(
                1,
                (new \ReflectionProperty(AffiliateApplicationAnswer::class, $property))
                    ->getAttributes(Required::class),
            );
        }
    }

    public function testAffiliateApplicationOmitsRemovedStructuredFields(): void
    {
        $removedProperties = [
            'audience',
            'country',
            'experience',
            'promotionChannels',
            'socialURLs',
            'websiteURL',
        ];

        foreach ($removedProperties as $property) {
            self::assertFalse(property_exists(AffiliateApplication::class, $property));
        }
    }

    public function testAffiliateInviteHydratesAndSetsExplicitNulls(): void
    {
        $payload = [
            'acceptedAt' => null,
            'firstName' => null,
            'lastName' => null,
            'revokedAt' => null,
        ];

        $invite = Conversion::coerce(AffiliateInvite::class, value: $payload);

        self::assertInstanceOf(AffiliateInvite::class, $invite);
        self::assertSame($payload, $invite->jsonSerialize());

        $withNulls = AffiliateInvite::with()
            ->withAcceptedAt(null)
            ->withFirstName(null)
            ->withLastName(null)
            ->withRevokedAt(null);

        self::assertSame($payload, $withNulls->jsonSerialize());
        $this->assertNullableMetadata(AffiliateInvite::class, [
            'acceptedAt',
            'firstName',
            'lastName',
            'revokedAt',
        ]);
    }

    /**
     * @param class-string $model
     * @param list<string> $properties
     */
    private function assertNullableMetadata(
        string $model,
        array $properties
    ): void {
        foreach ($properties as $property) {
            $attributes = (new \ReflectionProperty($model, $property))
                ->getAttributes(Optional::class);

            self::assertCount(1, $attributes);
            self::assertTrue(
                $attributes[0]->newInstance()->nullable,
                "{$model}::\${$property} must declare nullable hydration metadata",
            );
        }
    }

    /**
     * @param class-string $model
     * @param list<string> $properties
     */
    private function assertRequiredNullableMetadata(
        string $model,
        array $properties
    ): void {
        foreach ($properties as $property) {
            $attributes = (new \ReflectionProperty($model, $property))
                ->getAttributes(Required::class);

            self::assertCount(1, $attributes);
            self::assertTrue(
                $attributes[0]->newInstance()->nullable,
                "{$model}::\${$property} must declare nullable hydration metadata",
            );
        }
    }
}
