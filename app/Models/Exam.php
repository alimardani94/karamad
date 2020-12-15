<?php

namespace App\Models;

use App\Models\Syllabus;
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
 * @property string|null $start
 * @property string|null $time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question[] $questions
 * @property-read int|null $questions_count
 * @property-read Syllabus|null $syllabus
 * @method static \Illuminate\Database\Eloquent\Builder|Exam newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Exam newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Exam query()
 * @method static \Illuminate\Database\Eloquent\Builder|Exam whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exam whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exam whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exam whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exam whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exam whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exam whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exam whereUpdatedAt($value)
 * @mixin \Eloquent
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
