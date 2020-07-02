<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Course\OnlineCourse
 *
 * @property int $id
 * @property string $key
 * @property string $title
 * @property int $instructor_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\OnlineCourse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\OnlineCourse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\OnlineCourse query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\OnlineCourse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\OnlineCourse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\OnlineCourse whereInstructorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\OnlineCourse whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\OnlineCourse whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\OnlineCourse whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OnlineCourse extends Model
{
    //
}
