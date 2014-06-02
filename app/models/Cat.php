<?php
class Cat extends Eloquent
{
    /**
     * @var array
     */
    protected $fillable = array('name', 'desc', 'access');
}