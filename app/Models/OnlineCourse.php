<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OnlineCourse
 *
 * @property int $id
 * @property string $key
 * @property string $title
 * @property int $instructor_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OnlineCourse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OnlineCourse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OnlineCourse query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OnlineCourse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OnlineCourse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OnlineCourse whereInstructorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OnlineCourse whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OnlineCourse whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OnlineCourse whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OnlineCourse extends Model
{
    //
}
