<?php

namespace App\Models\Blog;

use App\Models\Comment;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Blog\Post
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string|null $image
 * @property int $author_id
 * @property string|null $meta_keywords
 * @property string|null $meta_description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Post whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Post whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Post whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Post whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Post whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Post whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Post extends Model
{
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function tagsArray()
    {
        return $this->tags()->pluck('name')->toArray();
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
