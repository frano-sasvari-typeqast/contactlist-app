<?php

namespace App\Repository;

use App\Model\Contact;

class ContactRepository extends Repository
{
    /**
     * The eloquent builder instance
     *
     * @var \App\Model\Contact
     */
    protected $queryBuilder;

    /**
     * The eloquent model name
     *
     * @var string
     */
    protected $model = Contact::class;

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
            ->with('phones');

        return $this;
    }
}
