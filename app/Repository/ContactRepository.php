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
    public function filterById(int $id) : ContactRepository
    {
        $this->queryBuilder = $this->queryBuilder
            ->where('id', $id);

        return $this;
    }

    /**
     * Filter contacts by keyword
     *
     * @param  string  $keyword
     * @return $this
     */
    public function filterByKeyword(string $keyword) : ContactRepository
    {
        $this->queryBuilder = $this->queryBuilder
            ->where(function ($query) use ($keyword) {
                $query->search($keyword);
                $query->orWhere('email', 'LIKE', '%'.$keyword.'%');
            });

        return $this;
    }

    /**
     * Load contact relations
     *
     * @return $this
     */
    public function loadRelations() : ContactRepository
    {
        $this->queryBuilder = $this->queryBuilder
            ->with('phoneNumbers');

        return $this;
    }
}
