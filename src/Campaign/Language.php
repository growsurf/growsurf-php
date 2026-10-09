<?php

declare(strict_types=1);

namespace Growsurf\Campaign;

/** A language a program can run in. Participants see the portal and receive program emails in their language. */
enum Language: string
{
    case EN = 'en';

    case ES = 'es';

    case FR = 'fr';

    case DE = 'de';

    case IT = 'it';

    case PT_BR = 'pt-BR';

    case NL = 'nl';

    case PL = 'pl';

    case SV = 'sv';

    case TR = 'tr';

    case JA = 'ja';

    case KO = 'ko';

    case ZH_CN = 'zh-CN';

    case ID = 'id';
}
