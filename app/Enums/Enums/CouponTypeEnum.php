<?php

namespace App\Enums\Enums;

enum CouponTypeEnum: string
{
    case FIXED = 'fixed';
    case PERCENTAGE = 'percentage';
}
