<?php

namespace Milyoomex\Enum;

enum WithdrawalTypeEnum: string
{
    case BLOCKCHAIN = 'blockchain';
    case INTERNAL   = 'internal';
}