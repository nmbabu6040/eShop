<?php

namespace App\Enums;

enum CouponTypeEnum: string
{
    case FIXED = 'fixed';
    case PERCENTAGE = 'percentage';
}
