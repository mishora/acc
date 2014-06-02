<?php
class NomenclaturesController extends BaseController
{
    /**
     ******************************   Officess   *******************************
     */
    // Nomenclatures - Officess (GET)
    public function getOffices()
    {
        $offices =  Office::all()->toArray();
        return View::make('nomenclatures.offices', array(
            'offices' => $offices
        ));
    }
    // Nomenclatures - Offices (POST)
    public function postOffices()
    {
        $validator = Validator::make(Input::all(), array(
            'name' => 'required|unique:offices|max:20',
            'desc' => ''
        ));

        if ($validator->fails()) {
            return Redirect::route('nomenclatures-offices')
                                    ->withErrors($validator)->withInput();
        } else {
            $office = new Office();
            $office->name = Input::get('name');
            $office->desc = Input::get('desc');

            if ($office->save()) {
                return Redirect::route('nomenclatures-offices')
                    ->with('msg-success', 'Data saved successfully!');
            }
        }

        return Redirect::route('nomenclatures-offices')
                    ->with('msg-fail', 'Unable to save data!');
    }
    // Nomenclatures - Edit Offices (POST)
    public function postOfficesEdit($id)
    {
        $validator = Validator::make(Input::all(), array(
            'name' => 'required|max:20',
            'desc' => ''
        ));

        if ($validator->fails()) {
            return Redirect::route('nomenclatures-offices-edit', array('id' => $id))
                                    ->withErrors($validator)->withInput();
        } else {
            $office = Office::where('id', $id)->take(1)->first();
            $office->name = Input::get('name');
            $office->desc = Input::get('desc');

            if ($office->save()) {
                return Redirect::route('nomenclatures-offices')
                    ->with('msg-success', 'Data updated successfully!');
            }
        }

        return Redirect::route('nomenclatures-offices')
                    ->with('msg-fail', 'Unable to update data!');
    }

    public function getOfficesEdit($id)
    {
        $office = Office::where('id', $id)->take(1);
        return View::make('nomenclatures.offices', array(
            'office' => $office->first()
        ));
    }

    public function getOfficesDelete($id)
    {
        $office = Office::find($id);
        if( $office ) {
            $office->delete();
            return Redirect::route('nomenclatures-offices')
                    ->with('msg-success', 'Data deleted successfully!');
        }
    }

    /**
     *****************************   Categories   ******************************
     */
    // Nomenclatures - Categories (GET)
    public function getCategories()
    {
        return View::make('nomenclatures.categories');
    }

    /**
     ******************************   Operators   ******************************
     */
    // Nomenclatures - Operators (GET)
    public function getOperators()
    {
        return View::make('nomenclatures.operators');
    }

}