<?php
class HomeController extends BaseController
{
    public function home()
    {
        return View::make ('home', array(
            'title' => 'DANS ENERGY - Home',
            'page' => 'home'
        ));
    }
}
