<?php

namespace App\Models;

use App\Enums\Instructor\InstructorType;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Instructor
 *
 * @property int $id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Instructor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Instructor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Instructor query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Instructor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Instructor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Instructor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Instructor whereUserId($value)
 * @mixin \Eloquent
 * @property int $type
 * @property string|null $name
 * @property string|null $surname
 * @property string $title
 * @property string|null $about
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Instructor whereAbout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Instructor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Instructor whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Instructor whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Instructor whereType($value)
 * @property-read \App\Models\User|null $user
 */
class Instructor extends Model
{
    protected $fillable = [
        'id', 'name', 'about', 'user_id', 'title', 'type',
    ];

    public function type()
    {
        return InstructorType::translatedKeyOf($this->type);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getNameAttribute($value)
    {
        return ($this->type == InstructorType::User) ? $this->user->full_name : $value;
    }
}
