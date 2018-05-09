<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PhoneNumber extends Eloquent
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'phone_number';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['label', 'number'];

    /**
     * Get the contact that owns the phone
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contact() : BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
}
