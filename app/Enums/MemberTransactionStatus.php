<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class MemberTransactionStatus extends Enum
{
    const NEW =   0;
    const APPROVED =   1;
    const REJECTED = 2;
    const IN_PROGRESS = 3;
}
