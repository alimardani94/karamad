<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Shop\Tag
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Tag extends Model
{

    protected $fillable = [
        'name',
    ];
}
