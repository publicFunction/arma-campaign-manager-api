<?php

namespace ARMACMan\Repositories;

/**
 * Provides properties and methods that are common to all repositories that back up an Eloquent model.
 *
 * Class EloquentRepository
 * @package ARMACMan\Repositories
 */
abstract class EloquentRepository
{
    /**
     * Eloquent model instance. Each individual repository is responsible for setting it.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Finds a single record identified by its ID and returns a model representing it.
     *
     * @param       $id
     * @param array $columns
     *
     * @return mixed
     */
    public function find($id, array $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    /**
     * Finds the first record found by the given attribute and value, and returns a model representing it.
     *
     * @param       $attribute
     * @param       $value
     * @param array $columns
     *
     * @return mixed
     */
    public function findBy($attribute, $value, array $columns = ['*'])
    {
        return $this->model->where($attribute, $value)->first($columns);
    }

    /**
     * Gets all records and returns a collection of model instances representing those records.
     *
     * @param array $columns
     *
     * @return mixed
     */
    public function get(array $columns = ['*'])
    {
        return $this->model->get($columns);
    }

    /**
     * Gets all records found by the given attribute and value, and returns a collection representing those records.
     *
     * @param       $attribute
     * @param       $value
     * @param array $columns
     *
     * @return mixed
     */
    public function getBy($attribute, $value, array $columns = ['*'])
    {
        return $this->model->where($attribute, $value)->get($columns);
    }

    /**
     * Gets a subset of all records and returns a paginated collection representing that subset.
     *
     * @param int   $perPage
     * @param array $columns
     *
     * @return mixed
     */
    public function paginate($perPage = 20, array $columns = ['*'])
    {
        return $this->model->paginate($perPage, $columns);
    }
}