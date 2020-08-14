<?php

namespace App\Models\Exam;

use App\Models\Course\Syllabus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Exam
 *
 * @property int $id
 * @property int $creator_id
 * @property string $title
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Exam newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Exam newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Exam query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Exam whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Exam whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Exam whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Exam whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Exam whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Exam whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question[] $questions
 * @property-read int|null $questions_count
 * @property string|null $start
 * @property string|null $time
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Exam whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Exam whereTime($value)
 * @property-read \App\Models\Course\Syllabus $syllabus
 */
class Exam extends Model
{

    /**
     * @return HasMany
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * only for exam syllabuses
     * @return HasOne
     */
    public function syllabus()
    {
        return $this->hasOne(Syllabus::class);
    }
}
