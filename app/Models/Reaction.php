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
 * @property-read Model|\Eloquent $entity
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction whereUserId($value)
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
