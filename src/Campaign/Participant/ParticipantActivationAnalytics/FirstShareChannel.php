<?php

declare(strict_types=1);

namespace Growsurf\Campaign\Participant\ParticipantActivationAnalytics;

enum FirstShareChannel: string
{
    case EMAIL = 'email';

    case FACEBOOK = 'facebook';

    case TWITTER = 'twitter';

    case LINKEDIN = 'linkedin';

    case PINTEREST = 'pinterest';

    case THREADS = 'threads';

    case BLUESKY = 'bluesky';

    case SMS = 'sms';

    case MESSENGER = 'messenger';

    case WHATSAPP = 'whatsapp';

    case WECHAT = 'wechat';

    case TELEGRAM = 'telegram';

    case REDDIT = 'reddit';

    case TUMBLR = 'tumblr';

    case QRCODE = 'qrcode';

    case COPY_REF_LINK = 'copyRefLink';

    case IOS_NATIVE_SHARE = 'iosNativeShare';

    case ANDROID_NATIVE_SHARE = 'androidNativeShare';
}
