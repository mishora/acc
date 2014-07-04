<?php
class ItemsController extends BaseController
{
    public function getAdd()
    {

        return View::make('add.add', array(
            'title' => 'DANS ENERGY - Add New Item',
            'page' => 'add'
        ));

    }

    public function postItemsAdd($id = null)
    {
        $redirect_path = 'add';
        $messages = array(
            'min' => 'The :attribute field is required.',
        );
        $rules = array(
            'office' => 'required|numeric|min:1',
            'cat' => 'required|numeric|min:0',
            'name' => 'required',
            'quantity' => 'required|numeric|min:0.00001',
            'price' => 'required|numeric|min:0.00001',
            'amount' => 'required|numeric|min:0.00001',
            'issue_date' => 'required',
            'pay_date' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->passes()) {

            $cat = Cat::find(Input::get('cat'));
            if (!$id) {
                $item = new Item();
            } else {
                $redirect_path = 'overview';
                $item = Item::findOrFail($id);
            }

            $item->office = Input::get('office');
            $item->cat = Input::get('cat');
            $item->name = Input::get('name');
            $item->desc = Input::get('desc');
            $item->quantity = Input::get('quantity');
            $item->price = Input::get('price');
            $item->amount = Input::get('amount');
            $item->issue_date = strtotime(Input::get('issue_date'));
            $item->pay_date = strtotime(Input::get('pay_date'));
            $item->inexact = Input::get('inexact') ? true : false;
            $item->reason = Input::get('reason');

            $item->access = $cat['access'];
            $item->type = $cat['type'];
            if ($item->save()) {
                return Redirect::route($redirect_path)
                        ->with('msg-success', 'Data saved successfully!');
            }
        } else {
            return Redirect::route($redirect_path)
                    ->withInput()->withErrors($validator);
        }
        return Redirect::route($redirect_path)
                    ->with('msg-fail', 'Unable to save data!');
    }

    // Items - Delete Item (GET)
    public function getItemsDelete($id)
    {
        $item = Item::find($id);
        if( $item ) {
            $item->delete();
            return Redirect::route('overview')
            ->with('msg-success', 'Data deleted successfully!');
        }
        return Redirect::route('overview')
        ->with('msg-fail', 'Unable to delete item!');
    }

    // Items - Edit Item (GET)
    public function getItemsEdit($id)
    {
        $item = Item::where('id', $id)->take(1);
        return View::make('add.add', array(
            'title' => 'DANS ENERGY - Edit New Item',
            'page' => 'add',
            'item' => $item->first()
        ));
    }

}
