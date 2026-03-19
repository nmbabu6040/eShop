<?php

namespace App\Enums;

enum OrderStatusEnums: string
{
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case DELIVERED = 'delivered';
    case CANCELLED = 'cancelled';
}
