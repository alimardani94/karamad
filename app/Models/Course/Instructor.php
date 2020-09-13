<?php

namespace App\Models\Course;

use App\Enums\Instructor\InstructorType;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Course\Instructor
 *
 * @property int $id
 * @property int $type
 * @property int|null $user_id
 * @property string $name
 * @property string $title
 * @property string|null $about
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string|null $image
 * @property-read string $slug
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Instructor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Instructor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Instructor query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Instructor whereAbout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Instructor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Instructor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Instructor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Instructor whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Instructor whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Instructor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Course\Instructor whereUserId($value)
 * @mixin \Eloquent
 */
class Instructor extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'id', 'name', 'about', 'user_id', 'title', 'type',
    ];

    /**
     * @param $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return ($this->type == InstructorType::User) ? $this->user->full_name : $value;
    }

    /**
     * @return string|null
     */
    public function getImageAttribute()
    {
        return isset($this->user) ? $this->user->image : null;
    }

    /**
     * @return string
     */
    public function getSlugAttribute()
    {
        return slugify($this->name);
    }

    /**
     * @return array|Application|Translator|string|null
     */
    public function type()
    {
        return InstructorType::translatedKeyOf($this->type);
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
