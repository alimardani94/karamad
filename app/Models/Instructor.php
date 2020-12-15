<?php

namespace App\Models;

use App\Enums\Instructor\InstructorType;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Instructor
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
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Instructor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Instructor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Instructor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Instructor whereAbout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Instructor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Instructor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Instructor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Instructor whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Instructor whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Instructor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Instructor whereUserId($value)
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
