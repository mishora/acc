<?php
class OverviewController extends BaseController
{
    // Overview - Get Overview (GET)
    public function getOverview($nav = null)
    {
        $offices_names = array();
        $cats_names = array();

        $offices = Office::all()->toArray();
        $cats = Cat::all()->toArray();
        $incomes = 0;
        $expenses = 0;
        $order = 'pay_date';

        foreach ($offices as $val) {
            $offices_names[$val['id']] = $val['name'];
        }

        foreach ($cats as $cat) {
            $cats_names[$cat['id']] = $cat['name'];
        }

        if (Session::has('order_by')) {
            $order = Session::get('order_by');
        }
        if (Session::has('order_direction')) {
            $order_direction = Session::get('order_direction');
        } else {
            $order_direction = 'asc';
        }

        $items = Item::whereRaw('access >='. Auth::user()->access .
                    $this::set_where())
                            ->orderBy($order, $order_direction)->get();

        foreach ($items as $item) {
            if ($item['type'] ==  0) {
                $incomes += $item['amount'];
            } else {
                $expenses += $item['amount'];
            }
        }

        return View::make ('overview.overview', array(
            'title' => 'DANS ENERGY - Overview',
            'page' => 'overview',
            'items' => $items,
            'offices_names' => $offices_names,
            'cats_names' => $cats_names,
            'incomes' => $incomes,
            'expenses' => $expenses,
            'offices' => $offices,
            'cats' => $cats,
        ));
    }
    // Overview - Mark items (GET)
    public function postMark()
    {
        $item = Item::findOrFail(Input::get('id'));

        if ($item->count()) {
            if ($item->mark(Input::get('type')) < 0) {
                return Redirect::route('overview')
                            ->with('msg-fail', 'Unable to save data!');
            }
        }
        return Redirect::route('overview');
        //return $this->getOverview();
    }
    // Overview - Set filters for get items query (GET)
    public function postOverviewFilters()
    {
        $offices_filter = Input::get('offices_filter');
        $type_filter = Input::get('type_filter');
        $cats_filter = Input::get('cats_filter');
        $from_date = strtotime(Input::get('from_date'));
        $to_date = strtotime(Input::get('to_date'));

        if ($from_date < 1000) {
            $from_date = strtotime(date('1-m-Y',time()));
        }
        if ($to_date < $from_date) {
            $to_date = $from_date;
        }

        Session::put('offices_filter', $offices_filter);
        Session::put('type_filter', $type_filter);
        Session::put('cats_filter', $cats_filter);
        Session::put('from_date', $from_date);
        Session::put('to_date', $to_date);

        return Redirect::route('overview');
    }
    // Overview - Set 'where' for the query (GET)
    private static function set_where()
    {
        $ret = '';
        if (Session::has('offices_filter')) {
            if (Session::get('offices_filter') > -1) {
                $ret .= ' AND office = '.Session::get('offices_filter');
            }
        }
        if (Session::has('type_filter')) {
            if (Session::get('type_filter') > -1) {
                $ret .= ' AND type = '.Session::get('type_filter');
            }
        }
        if (Session::has('cats_filter')) {
            if (Session::get('cats_filter') > -1) {
                $ret .= ' AND cat = '.Session::get('cats_filter');
            }
        }
        if (Session::has('from_date')) {
            if (Session::get('from_date') > 0) {
                $ret .= ' AND pay_date >= '.Session::get('from_date');
            }
        } else {
            Session::put('from_date', strtotime(date('1-m-Y')));
            $ret .= ' AND pay_date >= '.strtotime(date('1-m-Y'));
        }

        if (Session::has('to_date')) {
            if (Session::get('to_date') > 0) {
                $ret .= ' AND pay_date <= '.Session::get('to_date');
            }
        } else {
            Session::put('to_date',
                        strtotime('last day of this month', time()));
                $ret .= ' AND pay_date <= '.
                strtotime('last day of this month', time());
        }

        return $ret;
    }

    public function getOrderBy($by)
    {
        $order_direction = 'asc';
        if (Session::has('order_direction')) {
            $order_direction = (Session::get('order_direction')) == 'asc' ?
                'desc' : 'asc';
        }

        Session::put('order_by', $by);
        Session::put('order_direction', $order_direction);

        return Redirect::route('overview');
    }
}