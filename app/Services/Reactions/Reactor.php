<?php

namespace App\Services\Reactions;

use Illuminate\Database\Eloquent\Model;

interface Reactor
{
    /**
     * Set a reaction
     *
     * @param Model $entity
     * @param int $type
     * @param int $userId
     */
    public function set(Model $entity, int $type, int $userId): void;

    /**
     * Get a stored reaction
     *
     * @param Model $entity
     * @param int $userId
     * @return int|null
     */
    public function get(Model $entity, int $userId): ?int;

    /**
     * Count of reactions for given video
     *
     * @param Model $entity
     * @return int[][]
     */
    public function count(Model $entity): array;

    /**
     * Rate of entity to the percentage
     *
     * @param Model $entity
     * @return int
     */
    public function rate(Model $entity): int;
}
