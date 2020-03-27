<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Course
 *
 * @property int $id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course whereUserId($value)
 * @mixin \Eloquent
 * @property int $instructor_id
 * @property int $category_id
 * @property string $title
 * @property string $summary
 * @property string|null $description
 * @property string $slug
 * @property string|null $image
 * @property string|null $thumbnail
 * @property int $downloadable
 * @property int $price
 * @property int $discount
 * @property int $sell_count
 * @property int $seen_count
 * @property int $confirmed
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course whereConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course whereDownloadable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course whereInstructorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course whereSeenCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course whereSellCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course whereTitle($value)
 */
class Course extends Model
{
    //
}
