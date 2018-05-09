<?php

namespace App\Repository;

use App\Model\PhoneNumber;

class PhoneNumberRepository extends Repository
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
     * Filter phone numbers by id
     *
     * @param  int  $id
     * @return $this
     */
    public function filterById(int $id) : PhoneNumberRepository
    {
        $this->queryBuilder = $this->queryBuilder
            ->where('id', $id);

        return $this;
    }

    /**
     * Filter phone numbers by contact id
     *
     * @param  int  $contactId
     * @return $this
     */
    public function filterByContact(int $contactId) : PhoneNumberRepository
    {
        $this->queryBuilder = $this->queryBuilder
            ->where('contact_id', $contactId);

        return $this;
    }

    /**
     * Load phone number relations
     *
     * @param  int  $id
     * @return $this
     */
    public function loadRelations() : PhoneNumberRepository
    {
        $this->queryBuilder = $this->queryBuilder
            ->with('contact');

        return $this;
    }
}
