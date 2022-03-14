<?php

namespace Milyoonex\Enum;

enum WithdrawalTypeEnum: string
{
    case BLOCKCHAIN = 'blockchain';
    case INTERNAL   = 'internal';
}