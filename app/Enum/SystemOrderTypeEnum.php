<?php

namespace Milyoonex\Enum;

enum SystemOrderTypeEnum: string
{
    case STOP_LIMIT  = 'stop_limit';
    case STOP_MARKET = 'stop_market';
    case OCO         = 'oco';
}