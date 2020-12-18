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
 * App\Models\CourseCategory
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name
 * @property string|null $image
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|CourseCategory[] $children
 * @property-read int|null $children_count
 * @property-read CourseCategory $parent
 * @method static Builder|CourseCategory newModelQuery()
 * @method static Builder|CourseCategory newQuery()
 * @method static Builder|CourseCategory query()
 * @method static Builder|CourseCategory whereCreatedAt($value)
 * @method static Builder|CourseCategory whereDescription($value)
 * @method static Builder|CourseCategory whereId($value)
 * @method static Builder|CourseCategory whereImage($value)
 * @method static Builder|CourseCategory whereName($value)
 * @method static Builder|CourseCategory whereParentId($value)
 * @method static Builder|CourseCategory whereUpdatedAt($value)
 * @mixin Eloquent
 */
class CourseCategory extends Model
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
