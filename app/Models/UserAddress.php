<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserAddress
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserAddress[] $addresses
 * @property-read int|null $addresses_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property int $province_id
 * @property int $city_id
 * @property string $address
 * @property string|null $postal_Code
 * @property float|null $latitude
 * @property float|null $longitude
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereProvinceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereUserId($value)
 */
class UserAddress extends Model
{
    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }
}
