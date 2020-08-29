<?php

namespace App\Enums\Shop;

use App\Enums\Enum;

class OrderStatus extends Enum
{
    const Pending =  0;
    const Payed = 1;
    const Shipped = 3;
}
