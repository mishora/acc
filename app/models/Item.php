<?php
class Item extends Eloquent
{
    /**
     * @var array
     */
    protected $fillable = array(
        'office', 'type', 'cat', 'name', 'desc', 'quantity', 'price',
        'amount', 'issue_date', 'issue_check', 'pay_date',
        'status', 'created_at', 'updated_at'
    );
}