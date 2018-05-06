<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

abstract class Eloquent extends Model
{
    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 20;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Fields which have to be convert to null in case of empty imput.
     *
     * @var array
     */
    protected $nullable = [];

    /**
    * Listen for save event.
     *
     * @return void
    */
    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->setNullables();
        });
    }

    /**
    * Set empty nullable fields to null.
    *
    * @return void
    */
    protected function setNullables()
    {
        foreach ($this->nullable as $field) {
            if (empty($this->attributes[$field])) {
                $this->attributes[$field] = null;
            }
        }
    }
}
