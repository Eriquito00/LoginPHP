<?php

namespace App\Model\Repository;

/**
 * @template T
 */
interface Repository {
    /**
     * @param T $entity
     * @return void
     */
    public function create($entity);

    /**
     * @param T $entity
     * @param T $newEntity
     * @return void
     */
    public function update($entity, $newEntity);

    /**
     * @param T $entity
     * @return void
     */
    public function delete($entity);

    /**
     * @param int $id
     * @return T|null
     */
    public function get($id);
}
?>