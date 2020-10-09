<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Province
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\City[] $cities
 * @property-read int|null $cities_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Province newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Province newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Province query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Province whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Province whereName($value)
 */
class Province extends Model
{
    public $timestamps = false;

    /**
     * @return HasMany
     */
    public function cities(): HasMany
    {
        return $this->hasMany(City::class, 'province_id');
    }
}
