<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class WarningStatus extends Enum
{
    const NoWarning =   0;
    const Suspend =   1;
    const Blacklist = 2;
}
