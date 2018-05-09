<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Eloquent
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contact';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['firstname', 'lastname', 'email', 'upload_avatar', 'is_favorite'];

    /**
     * Fields which have to be convert to null in case of empty imput.
     *
     * @var array
     */
    protected $nullable = ['upload_avatar', 'is_favorite'];

    /**
     * Get name for notification
     *
     * @return string
     */
    public function getFullName() : string
    {
        return $this->firstname.' '.$this->lastname;
    }

    /**
     * Get the phones that belongs to the contact
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function phoneNumbers() : HasMany
    {
        return $this->hasMany(PhoneNumber::class);
    }
}
