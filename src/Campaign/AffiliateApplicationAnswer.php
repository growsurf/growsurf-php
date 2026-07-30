<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

use Growsurf\Campaign\AffiliateApplicationAnswer\Type;
use Growsurf\Core\Attributes\Required;
use Growsurf\Core\Concerns\SdkModel;
use Growsurf\Core\Contracts\BaseModel;

/**
 * @phpstan-type AffiliateApplicationAnswerShape = array{
 *   fieldID: string,
 *   label: string,
 *   type: Type|value-of<Type>,
 *   value: string|int|float|bool,
 * }
 */
final class AffiliateApplicationAnswer implements BaseModel
{
    /** @use SdkModel<AffiliateApplicationAnswerShape> */
    use SdkModel;

    /**
     * Stable key of the saved application-form field this answer belongs to.
     */
    #[Required('fieldId')]
    public string $fieldID;

    /**
     * Customer-configured field label captured when the applicant submitted.
     */
    #[Required]
    public string $label;

    /**
     * Saved field type that determined how the scalar answer was validated.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Applicant answer represented as one validated string, number, or boolean.
     */
    #[Required]
    public string|int|float|bool $value;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $fieldID,
        string $label,
        Type|string $type,
        string|int|float|bool $value,
    ): self {
        $self = new self;

        $self['fieldID'] = $fieldID;
        $self['label'] = $label;
        $self['type'] = $type;
        $self['value'] = $value;

        return $self;
    }

    /**
     * Stable key of the saved application-form field this answer belongs to.
     */
    public function withFieldID(string $fieldID): self
    {
        $self = clone $this;
        $self['fieldID'] = $fieldID;

        return $self;
    }

    /**
     * Customer-configured field label captured when the applicant submitted.
     */
    public function withLabel(string $label): self
    {
        $self = clone $this;
        $self['label'] = $label;

        return $self;
    }

    /**
     * Saved field type that determined how the scalar answer was validated.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Applicant answer represented as one validated string, number, or boolean.
     */
    public function withValue(string|int|float|bool $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
