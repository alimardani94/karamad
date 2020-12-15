<?php

namespace App\Models;

use App\Enums\InvoiceableStatus;
use App\Enums\Shop\ProductType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $products
 * @property int|null $address_id
 * @property int $total_price
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\UserAddress|null $address
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Invoice[] $invoices
 * @property-read int|null $invoices_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAddressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereProducts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 * @mixin \Eloquent
 */
class Order extends Model
{
    /**
     * @param bool $assoc
     * @return mixed
     */
    public function products($assoc = false)
    {
        return json_decode($this->products, $assoc);
    }

    /**
     * @return bool
     */
    public function needAddress()
    {
        $products = $this->products(true);
        $types = array_column($products, 'type');

        return in_array(ProductType::Physical, $types);
    }

    public function address()
    {
        return $this->belongsTo(UserAddress::class, 'address_id');
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return array|string|null
     */
    public function status()
    {
        return InvoiceableStatus::translatedKeyOf($this->status);
    }

    /**
     * @return MorphMany
     */
    public function invoices()
    {
        return $this->morphMany(Invoice::class, 'invoiceable');
    }
}
