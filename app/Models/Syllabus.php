<?php

namespace App\Models;

use App\Enums\FileDisk;
use App\Enums\Syllabus\SyllabusType;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Syllabus
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Syllabus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Syllabus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Syllabus query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $course_id
 * @property int $type
 * @property string $title
 * @property int|null $file_disk
 * @property string|null $text
 * @property string|null $video
 * @property string|null $audio
 * @property int $confirmed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Syllabus whereAudio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Syllabus whereConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Syllabus whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Syllabus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Syllabus whereFileDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Syllabus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Syllabus whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Syllabus whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Syllabus whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Syllabus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Syllabus whereVideo($value)
 * @property-read \App\Models\Course $course
 */
class Syllabus extends Model
{
    /**
     * @var string
     */
    protected $table = 'syllabuses';

    /**
     * @var array
     */
    protected $fillable = [
        'course_id', 'type', 'title', 'file_disk', 'text', 'video', 'audio', 'confirmed',
    ];

    public function type()
    {
        return SyllabusType::translatedKeyOf($this->type);
    }

    public function fileDisk()
    {
        return SyllabusType::translatedKeyOf($this->file_disk);
    }

    public function getVideoAttribute($value)
    {
        return ($this->file_disk == FileDisk::URL) ? $value : asset('media/' . $value);
    }

    public function getAudioAttribute($value)
    {
        return ($this->file_disk == FileDisk::URL) ? $value : asset('media/' . $value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
