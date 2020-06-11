<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Question
 *
 * @property int $id
 * @property string $title
 * @property string $a
 * @property string $b
 * @property string $c
 * @property string $d
 * @property string $answer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereD($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $exam_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereExamId($value)
 */
class Question extends Model
{
    //
}
