<?php
class AddController extends BaseController
{
    public function getAdd()
    {
        return View::make('add.add', array(
            'title' => 'DANS ENERGY - Add New Item',
            'page' => 'add'
        ));
    }
}