<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Cache\Repository as Cache;
use Illuminate\Config\Repository as Config;

abstract class Repository
{
    /**
     * The cache repository instance
     *
     * @var \Illuminate\Cache\Repository
     */
    protected $cache;

    /**
     * The config instance
     *
     * @var \Illuminate\Config\Repository
     */
    protected $config;

    /**
     * The eloquent builder instance
     *
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $queryBuilder;

    /**
     * Create new repository instance
     *
     * @param  \Illuminate\Cache\Repository  $cache
     * @param  \Illuminate\Config\Repository  $config
     * @return void
     */
    public function __construct(Cache $cache, Config $config)
    {
        $this->cache = $cache;
        $this->config = $config;
    }

    /**
     * Create new eloquent query builder contact instance
     *
     * @return $this
     */
    public function newQuery() : Repository
    {
        $this->queryBuilder = new $this->model;

        return $this;
    }

    /**
     * Get all eloquent models
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function get() : Collection
    {
        return $this->queryBuilder->get();
    }

    /**
     * Get paginated eloquent models
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage = 20) : LengthAwarePaginator
    {
        return $this->queryBuilder->paginate($perPage);
    }

    /**
     * Get first eloquent model
     *
     * @return \App\Model\Eloquent|null
     */
    public function first()
    {
        return $this->queryBuilder->first();
    }

    /**
     * Get first eloquent model
     *
     * @param  array  $attributes
     * @return \App\Model\Eloquent|null
     */
    public function create(array $attributes = [])
    {
        return $this->queryBuilder->create($attributes);
    }

    /**
     * Get first eloquent model
     *
     * @param  array  $values
     * @return \App\Model\Eloquent|null
     */
    public function update(array $values = [])
    {
        return $this->queryBuilder->update($values);
    }

    /**
     * Get first eloquent model
     *
     * @return \App\Model\Eloquent|null
     */
    public function delete()
    {
        return $this->queryBuilder->delete();
    }
}
