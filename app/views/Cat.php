<?php
class Cat extends Eloquent
{
    /**
     * @var array
     */
    protected $fillable = array('name', 'type', 'desc', 'access');
}