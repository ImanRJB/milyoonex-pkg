<?php

namespace Milyoonex\Enum;

enum User2faEnum: string
{
    case OFF = 'off';
    case SMS = 'sms';
    case GA  = 'ga';
}