<?php

namespace Milyoonex\Enum;

enum IrtDepositStatusEnum: string
{
    case PENDING    = 'pending';
    case SUCCESSFUL = 'successful';
    case FAILED     = 'failed';
    case REFUNDED   = 'refunded';
}