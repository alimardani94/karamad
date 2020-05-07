<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Blog\Comment
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $ip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Comment whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Comment whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Comment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Comment whereUserId($value)
 * @mixin \Eloquent
 * @property string $body
 * @property int $commentable_type
 * @property int $commentable_id
 * @property int|null $parent_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Comment whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Comment whereCommentableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Comment whereCommentableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Comment whereParentId($value)
 */
class Comment extends Model
{
    //
}
