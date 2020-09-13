<?php

namespace App\Models\Course;

use App\Enums\FileDisk;
use App\Enums\Syllabus\SyllabusType;
use App\Models\Exam\Exam;
use App\Models\Exam\Question;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Course\Syllabus
 *
 * @property int $id
 * @property int $course_id
 * @property int $type
 * @property string $title
 * @property int|null $file_disk
 * @property string|null $text
 * @property string|null $video
 * @property string|null $audio
 * @property int|null $exam_id
 * @property int $confirmed
 * @property string|null $meta_keywords
 * @property string|null $meta_description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $attachments
 * @property-read \App\Models\Course\Course $course
 * @property-read \App\Models\Exam\Exam|null $exam
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Exam\Question[] $questions
 * @property-read int|null $questions_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Syllabus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Syllabus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Syllabus query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Syllabus whereAttachments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Syllabus whereAudio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Syllabus whereConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Syllabus whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Syllabus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Syllabus whereExamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Syllabus whereFileDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Syllabus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Syllabus whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Syllabus whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Syllabus whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Syllabus whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Syllabus whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Syllabus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Syllabus whereVideo($value)
 * @mixin \Eloquent
 * @property-read string $slug
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

    /**
     * @return string
     */
    public function getSlugAttribute()
    {
        return slugify($this->title);
    }

    /**
     * @return array|Application|Translator|string|null
     */
    public function type()
    {
        return SyllabusType::translatedKeyOf($this->type);
    }

    /**
     * @return array|Application|Translator|string|null
     */
    public function fileDisk()
    {
        return SyllabusType::translatedKeyOf($this->file_disk);
    }

    /**
     * @return string|null
     */
    public function video()
    {
        return ($this->file_disk == FileDisk::URL or !$this->video) ? $this->video : asset('media/' . $this->video);
    }

    /**
     * @return string|null
     */
    public function audio()
    {
        return ($this->file_disk == FileDisk::URL or !$this->audio) ? $this->audio : asset('media/' . $this->audio);
    }

    /**
     * @return BelongsTo
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * @return BelongsTo
     */
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    /**
     * @return HasMany
     */
    public function questions()
    {
        return $this->hasMany(Question::class, 'exam_id', 'exam_id');
    }

    /**
     * @param bool $assoc
     * @param null $default
     * @return mixed|null
     */
    public function attachments($assoc = false, $default = null)
    {
        $rawAttachments = json_decode($this->attachments) ?? [];
        $attachments = [];

        foreach ($rawAttachments as $index => $attachment) {
            $attachments[$index]['title'] = $attachment->title;
            $attachments[$index]['path'] = asset('media/' . $attachment->path);
            $extension = pathinfo($attachment->path, PATHINFO_EXTENSION);
            switch ($extension) {
                case('png'):
                case('jpeg'):
                case('jpg'):
                    $attachments[$index]['color'] = 'blue';
                    $attachments[$index]['icon'] = 'fal fa-file-image';
                    break;
                case('pdf'):
                    $attachments[$index]['color'] = 'red';
                    $attachments[$index]['icon'] = 'fal fa-file-pdf';
                    break;
                case('doc'):
                    $attachments[$index]['color'] = 'blue';
                    $attachments[$index]['icon'] = 'fal fa-file-word';
                    break;
                case('zip'):
                case('rar'):
                    $attachments[$index]['color'] = 'green';
                    $attachments[$index]['icon'] = 'fal fa-file-archive';
                    break;
                case('mp3'):
                case('mpga'):
                    $attachments[$index]['color'] = 'deep-orange';
                    $attachments[$index]['icon'] = 'fal fa-file-music';
                    break;
                case('mp4'):
                case('avi'):
                case('mov'):
                    $attachments[$index]['color'] = 'purple';
                    $attachments[$index]['icon'] = 'fal fa-file-video';
                    break;
                default:
                    $attachments[$index]['color'] = 'indigo';
                    $attachments[$index]['icon'] = 'fal fa-file-alt';
                    break;
            }
        }

        if (count($attachments)) {
            return json_decode(json_encode($attachments), $assoc);
        }

        return $default;
    }
}
