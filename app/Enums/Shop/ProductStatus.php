<?php

namespace App\Enums\Shop;

use App\Enums\Enum;

class ProductStatus extends Enum
{
    const PENDING = 0;
    const REJECTED = 2;
    const CONFIRMED = 4;
}
