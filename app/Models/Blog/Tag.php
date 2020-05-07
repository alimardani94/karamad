<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Blog\Tag
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Tag extends Model
{
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
