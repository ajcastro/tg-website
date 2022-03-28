<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PromotionType extends Enum
{
    const OneTime   = 0;
    const Daily     = 1;
    const Weekly    = 2;
    const Monthly   = 3;
    const Everytime = 3;
}
