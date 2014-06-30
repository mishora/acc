<?php
class OverviewController extends BaseController
{
    public function getOverview()
    {
        $offices_names = array();
        $cats_names = array();
        $items = Item::all()->toArray();
        $offices = Office::all()->toArray();
        $cats = Cat::all()->toArray();

        foreach ($offices as $val) {
            $offices_names[$val['id']] = $val['name'];
        }

        foreach ($cats as $cat) {
            $cats_names[$cat['id']] = $cat['name'];
        }

        return View::make ('overview.overview', array(
            'title' => 'DANS ENERGY - Overview',
            'page' => 'overview',
            'items' => $items,
            'offices_names' => $offices_names,
            'cats_names' => $cats_names
        ));
    }
}