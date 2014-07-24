<?php
class Partner extends Eloquent
{
    protected $table = 'partners';

    /**
     * @var array
     */
    protected $fillable = array(
        'short_name',
        'full_name',
        'mol',
        'country',
        'eic',
        'vat',
        'bank',
        'bic',
        'iban',
        'address',
        'mail',
        'phone',
    );

    public $timestamps = false;
}