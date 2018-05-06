<?php

namespace App\Repository;

use App\Model\Phone;

class PhoneRepository extends Repository
{
    /**
     * The eloquent builder instance
     *
     * @var \App\Model\Phone
     */
    protected $queryBuilder;

    /**
     * The eloquent model name
     *
     * @var string
     */
    protected $model = Phone::class;

    /**
     * Filter contacts by id
     *
     * @param  int  $id
     * @return $this
     */
    public function filterById($id)
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
    public function loadRelations()
    {
        $this->queryBuilder
            ->with('contact');

        return $this;
    }
}
