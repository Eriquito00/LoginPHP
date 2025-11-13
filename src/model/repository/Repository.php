<?php

namespace App\Model\Repository;

/**
 * @template T of object
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
     * @return array
     */
    public function getAll() : array;

    /**
     * @param T $entity
     * @return T|null
     */
    public function get($entity);
}
?>