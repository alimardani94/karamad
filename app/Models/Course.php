<?php

namespace App\Models;

use App\Services\Reactions\Reactor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Course
 *
 * @property int $id
 * @property int $instructor_id
 * @property int $category_id
 * @property string $title
 * @property string $summary
 * @property string|null $description
 * @property string|null $image
 * @property string|null $thumbnail
 * @property int $price
 * @property int $discount
 * @property int $sell_count
 * @property int $seen_count
 * @property string|null $meta_keywords
 * @property string|null $meta_description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read string $slug
 * @property-read \App\Models\Instructor $instructor
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Syllabus[] $syllabuses
 * @property-read int|null $syllabuses_count
 * @method static \Illuminate\Database\Eloquent\Builder|Course newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Course newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Course query()
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereInstructorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereSeenCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereSellCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Course extends Model
{
    /**
     * @return string
     */
    public function getSlugAttribute()
    {
        return slugify($this->title);
    }

    /**
     * @return BelongsTo
     */
    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return HasMany
     */
    public function syllabuses()
    {
        return $this->hasMany(Syllabus::class);
    }

    /**
     * @return int|null
     */
    public function reaction() {
        /** @var Reactor $reactor */
        $reactor = app(Reactor::class);
        return $reactor->get($this, auth()->id() ?: 0);
    }

    /**
     * @return int
     */
    public function rate() {
        /** @var Reactor $reactor */
        $reactor = app(Reactor::class);
        return $reactor->rate($this);
    }
}
