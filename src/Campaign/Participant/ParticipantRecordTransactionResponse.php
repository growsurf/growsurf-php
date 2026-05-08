<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant;

use Growsurf\Campaign\Participant\ParticipantRecordTransactionResponse\UnionMember0;
use Growsurf\Campaign\Participant\ParticipantRecordTransactionResponse\UnionMember1;
use Growsurf\Core\Concerns\SdkUnion;
use Growsurf\Core\Conversion\Contracts\Converter;
use Growsurf\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-import-type UnionMember0Shape from \Growsurf\Campaign\Participant\ParticipantRecordTransactionResponse\UnionMember0
 * @phpstan-import-type UnionMember1Shape from \Growsurf\Campaign\Participant\ParticipantRecordTransactionResponse\UnionMember1
 *
 * @phpstan-type ParticipantRecordTransactionResponseVariants = UnionMember0|UnionMember1
 * @phpstan-type ParticipantRecordTransactionResponseShape = ParticipantRecordTransactionResponseVariants|UnionMember0Shape|UnionMember1Shape
 */
final class ParticipantRecordTransactionResponse implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [UnionMember0::class, UnionMember1::class];
    }
}
