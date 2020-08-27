<?php

namespace App\Models\Course;

use App\CourseUser;
use App\Models\Category;
use App\Services\Reactions\Reactor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Course\Course
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
 * @property-read \App\Models\Course\Category $category
 * @property-read \App\Models\Course\Instructor $instructor
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Course\Syllabus[] $syllabuses
 * @property-read int|null $syllabuses_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Course newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Course newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Course query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Course whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Course whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Course whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Course whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Course whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Course whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Course whereInstructorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Course whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Course whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Course wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Course whereSeenCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Course whereSellCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Course whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Course whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Course whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Course whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Course extends Model
{
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
