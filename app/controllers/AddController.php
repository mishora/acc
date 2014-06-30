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

    public function postAdd()
    {
        $messages = array(
            'min' => 'The :attribute field is required.',
        );
        $rules = array(
            'office' => 'required|numeric|min:1',
            'cat' => 'required|numeric|min:0',
            'name' => 'required',
            'desc' => 'required',
            'quantity' => 'required|numeric|min:0.00001',
            'price' => 'required|numeric|min:0.00001',
            'amount' => 'required|numeric|min:0.00001',
            'issue_date' => 'required',
            'pay_date' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->passes()) {

            $cat = Cat::find(Input::get('cat'));
            $item = null;
            $item = new Item();
            $item->office = Input::get('office');
            $item->cat = Input::get('cat');
            $item->name = Input::get('name');
            $item->desc = Input::get('desc');
            $item->quantity = Input::get('quantity');
            $item->price = Input::get('price');
            $item->amount = Input::get('amount');
            $item->issue_date = Input::get('issue_date');
            $item->pay_date = Input::get('pay_date');

            $item->access = $cat['access'];
            $item->type = $cat['type'];
            if ($item->save()) {
                return Redirect::route('add')
                        ->with('msg-success', 'Data saved successfully!');
            }
        } else {
            return Redirect::route('add')->withInput()->withErrors($validator);
        }
        return Redirect::route('add')->with('msg-fail', 'Unable to save data!');
    }
}