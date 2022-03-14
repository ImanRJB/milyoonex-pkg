<?php

namespace Milyoonex\Enum;

enum OrderStatusEnum: string
{
    case CANCEL  = 'cancel';
    case CLOSE   = 'close';
    case OPEN    = 'open';
}