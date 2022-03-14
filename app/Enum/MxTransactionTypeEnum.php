<?php

namespace Milyoonex\Enum;

enum MxTransactionTypeEnum: string
{
    case CASH_OUT = 'cash_out';
    case FEE_P2P  = 'fee_p2p';
    case FEE_OTC  = 'fee_otc';
    case REWARD  = 'reward';
}