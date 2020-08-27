<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * App\Models\Reaction
 *
 * @property int $id
 * @property string $entity_type
 * @property int $entity_id
 * @property int $type
 * @property int $user_id
 * @property string|null $meta
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $entity
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reaction whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reaction whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reaction whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reaction whereUserId($value)
 * @mixin \Eloquent
 */
class Reaction extends Model
{
    /**
     * @return MorphTo
     */
    public function entity()
    {
        return $this->morphTo();
    }
}
