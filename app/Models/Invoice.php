<?php

namespace App\Models;

use App\Enums\InvoiceableStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * App\Models\Invoice
 *
 * @property int $id
 * @property int $user_id
 * @property string $invoiceable_type
 * @property int $invoiceable_id
 * @property int $amount
 * @property string $gateway
 * @property int $status
 * @property mixed|null $meta
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $invoiceable
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transaction[] $transactions
 * @property-read int|null $transactions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice query()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereGateway($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereInvoiceableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereInvoiceableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereUserId($value)
 * @mixin \Eloquent
 */
class Invoice extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * @return array|string|null
     */
    public function status()
    {
        return InvoiceableStatus::translatedKeyOf($this->status);
    }

    /**
     * @return MorphTo
     */
    public function invoiceable()
    {
        return $this->morphTo();
    }

    /**
     * @return HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
