<?php

namespace peczis\pecCms\Repositories\Contracts;

/*
 * Abstract repository interface
 */
interface RepositoryInterface {

    /**
     * Get all objects
     *
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'));

    /**
     * Paginate objects
     *
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = array('*'));

    /**
     * Create new object
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Update object
     *
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id, $attribute = "id");

    /**
     * Destroy object
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id);

    /**
     * Find an objects by id
     *
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*'));

    /**
     * Find objects by attribute
     *
     * @param $field
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($field, $value, $columns = array('*'));
}