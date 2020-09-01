<?php

namespace App\Services\Reactions;

use App\Models\Course\Course;
use App\Models\Reaction;
use App\Services\Reactions\Enums\ReactionTypes;
use Illuminate\Database\Eloquent\Model;

class SessionReactor implements Reactor
{
    /**
     * @inheritDoc
     */
    public function get(Model $entity, int $userId): ?int
    {
        $entityType = strtolower(class_basename($entity));
        if ($r = Reaction::find(session($this->key($entityType, $entity->id)))) {
            return $r->type;
        }

        if ($userId != null and $r = Reaction::whereEntityType(get_class($entity))->where('entity_id', $entity->id)->where('user_id', $userId)->first()) {
            return $r->type;
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function set(Model $entity, int $type, int $userId): void
    {
        $entityType = get_class($entity);
        $id = session($this->key($entityType, $entity->id));

        if (empty($reaction = Reaction::find($id))) {
            if ($userId != null and empty($r = Reaction::whereEntityType(get_class($entity))->where('entity_id', $entity->id)->where('user_id', $userId)->first())) {
                $reaction = new Reaction();
            }
        }

        $reaction->entity_type = $entityType;
        $reaction->entity_id = $entity->id;
        $reaction->user_id = $userId;
        $reaction->type = $type;
        $reaction->meta = json_encode([
            'session' => session()->getId(),
            'agent' => request()->userAgent(),
            'ip' => request()->ip(),
        ]);
        $reaction->save();

        session()->put($this->key($entityType, $entity->id), $reaction->id);
    }

    /**
     * Generate session key
     *
     * @param string $entityType
     * @param int $entityId
     * @return string
     */
    private function key(string $entityType, int $entityId): string
    {
        return join(':', ['reaction', $entityType, $entityId]);
    }

    /**
     * @inheritDoc
     */
    public function count(Model $entity): array
    {
        $entityType = get_class($entity);

        $reactions = [];
        foreach (Reaction::whereEntityType($entityType)->whereEntityId($entity->id)->get() as $r) {
            isset($reactions[$r->type]) ? $reactions[$r->type]++ : $reactions[$r->type] = 1;
        }

        return $reactions;
    }

    /**
     * @inheritDoc
     */
    public function rate(Model $entity): int
    {
        $entityType = strtolower(class_basename($entity));

        $entityPopularity = array_count_values(Reaction::whereEntityType($entityType)->where('type', ReactionTypes::LIKE)
            ->pluck('entity_id')->toArray());
        arsort($entityPopularity);

        $mostPopular = reset($entityPopularity);

        return isset($entityPopularity[$entity->id]) ? $entityPopularity[$entity->id] * 100 / $mostPopular : 0;
    }
}
