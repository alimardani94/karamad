<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;


/**
 * App\Models\Course\Category
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name
 * @property string $image
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Course\Category[] $children
 * @property-read int|null $children_count
 * @property-read \App\Models\Course\Category $parent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Category whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereType($value)
 */
class Category extends Model
{

    protected $fillable = [
        'id', 'parent_id', 'name', 'image', 'description',
    ];

    /**
     * @return BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    /**
     * @return HasMany
     */
    public function children()
    {
        return $this->hasMany(static::class, 'parent_id');
    }
}
