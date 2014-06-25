<?php
class OverviewController extends BaseController
{
    public function getOverview()
    {
        return View::make ('overview.overview', array(
            'title' => 'DANS ENERGY - Overview',
            'page' => 'overview'
        ));
    }
}