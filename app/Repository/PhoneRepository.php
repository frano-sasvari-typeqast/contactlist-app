<?php

namespace App\Repository;

use App\Model\PhoneNumber;

class PhoneRepository extends Repository
{
    /**
     * The eloquent builder instance
     *
     * @var \App\Model\PhoneNumber
     */
    protected $queryBuilder;

    /**
     * The eloquent model name
     *
     * @var string
     */
    protected $model = PhoneNumber::class;

    /**
     * Filter contacts by id
     *
     * @param  int  $id
     * @return $this
     */
    public function filterById(int $id) : PhoneRepository
    {
        $this->queryBuilder
            ->where('id', $id);

        return $this;
    }

    /**
     * Filter contacts by id
     *
     * @param  int  $id
     * @return $this
     */
    public function loadRelations() : PhoneRepository
    {
        $this->queryBuilder
            ->with('contact');

        return $this;
    }
}
