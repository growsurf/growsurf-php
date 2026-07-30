<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Campaign\AffiliateApplication\RiskLevel;
use Growsurf\Campaign\AffiliateApplication\Status;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type AffiliateApplicationAnswerShape from \Growsurf\Campaign\AffiliateApplicationAnswer
 *
 * @phpstan-type AffiliateApplicationShape = array{
 *   id: string,
 *   answers: list<AffiliateApplicationAnswer|AffiliateApplicationAnswerShape>,
 *   createdAt: int,
 *   decidedAt: int|null,
 *   email: string|null,
 *   firstName: string|null,
 *   lastName: string|null,
 *   participantID: string|null,
 *   reapplyAllowedAt: int|null,
 *   rejectionReason: string|null,
 *   reviewedAt: int|null,
 *   riskLevel: RiskLevel|value-of<RiskLevel>|null,
 *   status: Status|value-of<Status>,
 *   termsAcceptedAt: int|null,
 * }
 */
final class AffiliateApplication implements BaseModel
{
    /** @use SdkModel<AffiliateApplicationShape> */
    use SdkModel;

    /**
     * Application ID.
     */
    #[Required]
    public string $id;

    /**
     * The applicant's answers to the saved application form.
     *
     * @var list<AffiliateApplicationAnswer> $answers
     */
    #[Required(list: AffiliateApplicationAnswer::class)]
    public array $answers;

    /**
     * When the application was submitted, in Unix milliseconds.
     */
    #[Required]
    public int $createdAt;

    /**
     * When the decision was made, in Unix milliseconds. `null` while pending.
     */
    #[Required(nullable: true)]
    public ?int $decidedAt;

    /**
     * Required applicant email address, or `null` after applicant data is removed under the Program's retention policy.
     */
    #[Required(nullable: true)]
    public ?string $email;

    /**
     * Required applicant first name, or `null` after applicant data is removed under the Program's retention policy.
     */
    #[Required(nullable: true)]
    public ?string $firstName;

    /**
     * Required applicant last name, or `null` after applicant data is removed under the Program's retention policy.
     */
    #[Required(nullable: true)]
    public ?string $lastName;

    /**
     * ID of the participant created or upgraded by approval. `null` until the application is approved.
     */
    #[Required('participantId', nullable: true)]
    public ?string $participantID;

    /**
     * When a denied applicant may apply again, in Unix milliseconds. `null` when not applicable.
     */
    #[Required(nullable: true)]
    public ?int $reapplyAllowedAt;

    /**
     * The structured reason recorded when the application was denied. `null` until then.
     */
    #[Required(nullable: true)]
    public ?string $rejectionReason;

    /**
     * When the application was reviewed, in Unix milliseconds. `null` while pending.
     */
    #[Required(nullable: true)]
    public ?int $reviewedAt;

    /**
     * GrowSurf risk assessment. Applications that are not `LOW` risk are held for manual review; `null` means no assessment was recorded.
     *
     * @var value-of<RiskLevel>|null $riskLevel
     */
    #[Required(enum: RiskLevel::class, nullable: true)]
    public ?string $riskLevel;

    /**
     * Where the application is in review. Only `PENDING` applications can be decided.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * When the applicant accepted the Program Terms, in Unix milliseconds, or `null` when acceptance was not required.
     */
    #[Required(nullable: true)]
    public ?int $termsAcceptedAt;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<AffiliateApplicationAnswer|AffiliateApplicationAnswerShape> $answers
     * @param RiskLevel|value-of<RiskLevel>|null $riskLevel
     * @param Status|value-of<Status> $status
     */
    public static function with(
        string $id,
        array $answers,
        int $createdAt,
        ?int $decidedAt,
        ?string $email,
        ?string $firstName,
        ?string $lastName,
        ?string $participantID,
        ?int $reapplyAllowedAt,
        ?string $rejectionReason,
        ?int $reviewedAt,
        RiskLevel|string|null $riskLevel,
        Status|string $status,
        ?int $termsAcceptedAt,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['answers'] = $answers;
        $self['createdAt'] = $createdAt;
        $self['decidedAt'] = $decidedAt;
        $self['email'] = $email;
        $self['firstName'] = $firstName;
        $self['lastName'] = $lastName;
        $self['participantID'] = $participantID;
        $self['reapplyAllowedAt'] = $reapplyAllowedAt;
        $self['rejectionReason'] = $rejectionReason;
        $self['reviewedAt'] = $reviewedAt;
        $self['riskLevel'] = $riskLevel;
        $self['status'] = $status;
        $self['termsAcceptedAt'] = $termsAcceptedAt;

        return $self;
    }

    /**
     * Application ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The applicant's answers to the saved application form.
     *
     * @param list<AffiliateApplicationAnswer|AffiliateApplicationAnswerShape> $answers
     */
    public function withAnswers(array $answers): self
    {
        $self = clone $this;
        $self['answers'] = $answers;

        return $self;
    }

    /**
     * When the application was submitted, in Unix milliseconds.
     */
    public function withCreatedAt(int $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * When the decision was made, in Unix milliseconds. `null` while pending.
     */
    public function withDecidedAt(?int $decidedAt): self
    {
        $self = clone $this;
        $self['decidedAt'] = $decidedAt;

        return $self;
    }

    /**
     * Required applicant email address, or `null` after applicant data is removed under the Program's retention policy.
     */
    public function withEmail(?string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * Required applicant first name, or `null` after applicant data is removed under the Program's retention policy.
     */
    public function withFirstName(?string $firstName): self
    {
        $self = clone $this;
        $self['firstName'] = $firstName;

        return $self;
    }

    /**
     * Required applicant last name, or `null` after applicant data is removed under the Program's retention policy.
     */
    public function withLastName(?string $lastName): self
    {
        $self = clone $this;
        $self['lastName'] = $lastName;

        return $self;
    }

    /**
     * ID of the participant created or upgraded by approval. `null` until the application is approved.
     */
    public function withParticipantID(?string $participantID): self
    {
        $self = clone $this;
        $self['participantID'] = $participantID;

        return $self;
    }

    /**
     * When a denied applicant may apply again, in Unix milliseconds. `null` when not applicable.
     */
    public function withReapplyAllowedAt(?int $reapplyAllowedAt): self
    {
        $self = clone $this;
        $self['reapplyAllowedAt'] = $reapplyAllowedAt;

        return $self;
    }

    /**
     * The structured reason recorded when the application was denied. `null` until then.
     */
    public function withRejectionReason(?string $rejectionReason): self
    {
        $self = clone $this;
        $self['rejectionReason'] = $rejectionReason;

        return $self;
    }

    /**
     * When the application was reviewed, in Unix milliseconds. `null` while pending.
     */
    public function withReviewedAt(?int $reviewedAt): self
    {
        $self = clone $this;
        $self['reviewedAt'] = $reviewedAt;

        return $self;
    }

    /**
     * GrowSurf risk assessment. Applications that are not `LOW` risk are held for manual review; `null` means no assessment was recorded.
     *
     * @param RiskLevel|value-of<RiskLevel>|null $riskLevel
     */
    public function withRiskLevel(RiskLevel|string|null $riskLevel): self
    {
        $self = clone $this;
        $self['riskLevel'] = $riskLevel;

        return $self;
    }

    /**
     * Where the application is in review. Only `PENDING` applications can be decided.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * When the applicant accepted the Program Terms, in Unix milliseconds, or `null` when acceptance was not required.
     */
    public function withTermsAcceptedAt(?int $termsAcceptedAt): self
    {
        $self = clone $this;
        $self['termsAcceptedAt'] = $termsAcceptedAt;

        return $self;
    }

}
