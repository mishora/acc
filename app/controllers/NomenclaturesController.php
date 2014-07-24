<?php
class NomenclaturesController extends BaseController
{
    /**
     ******************************   Offices   ********************************
     */
    // Nomenclatures - Offices (GET)
    public function getOffices()
    {
        $offices =  Office::all()->toArray();
        return View::make('nomenclatures.offices', array(
            'title' => 'DANS ENERGY - Offices',
            'page' => 'nomenclatures',
            'offices' => $offices
        ));
    }
    // Nomenclatures - Offices Edit (GET)
    public function getOfficesEdit($id)
    {
        $office = Office::where('id', $id)->take(1);
        return View::make('nomenclatures.offices', array(
            'title' => 'DANS ENERGY - Edit Offices',
            'page' => 'nomenclatures',
            'office' => $office->first()
        ));
    }
    // Nomenclatures - Offices Delete (GET)
    public function getOfficesDelete($id)
    {
        $office = Office::find($id);
        if( $office ) {
            $office->delete();
            return Redirect::route('nomenclatures-offices')
                ->with('msg-success', 'Data deleted successfully!');
        }
        return Redirect::route('nomenclatures-offices')
            ->with('msg-fail', 'Unable to delete office!');
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
            return Redirect::route('nomenclatures-offices-edit',
                    array('id' => $id))->withErrors($validator)->withInput();
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
    // Nomenclatures - Get list of offices
    public static function getOfficesList()
    {
        return Office::all();
    }

    /**
     ******************************   Partners   *******************************
     */
    // Nomenclatures - Partners (GET)
    public function getPartners()
    {
        $partners =  Partner::all()->toArray();
        return View::make('nomenclatures.partners', array(
            'title' => 'DANS ENERGY - Partners',
            'page' => 'nomenclatures',
            'partners' => $partners
        ));
    }

    // Nomenclatures - Partners Edit (GET)
    public function getPartnersEdit($id)
    {
        $partner = Partner::where('id', $id)->take(1);
        return View::make('nomenclatures.partners', array(
            'title' => 'DANS ENERGY - Edit Partners',
            'page' => 'nomenclatures',
            'partner' => $partner->first()
        ));
    }

    // Nomenclatures - Partners Delete (GET)
    public function getPartnersDelete()
    {

    }

    // Nomenclatures - Partners (POST)
    public function postPartners()
    {
        $messages = array(
            'min' => 'The :attribute field is required.',
        );

        $validator = Validator::make(Input::all(), array(
            'short_name' => 'required|unique:partners|max:32',
            'full_name' => 'unique:partners|max:255',
            'country' => 'numeric|min:1',
            'mail' => 'email'
        ), $messages);

        if ($validator->passes()) {
            $partner = new Partner();
            $partner->short_name = Input::get('short_name');
            $partner->full_name = Input::get('full_name');
            $partner->mol = Input::get('mol');
            $partner->country = Input::get('country');
            $partner->eic = Input::get('eic');
            $partner->vat = Input::get('vat');
            $partner->bank = Input::get('bank');
            $partner->bic = Input::get('bic');
            $partner->iban = Input::get('iban');
            $partner->address = Input::get('address');
            $partner->mail = Input::get('mail');
            $partner->phone = Input::get('phone');
            if ($partner->save()) {
                return Redirect::route('nomenclatures-partners')
                    ->with('msg-success', 'Data saved successfully!');
            }
        } else {
            return Redirect::route('nomenclatures-partners')
                        ->withErrors($validator)->withInput();
        }

        return Redirect::route('nomenclatures-partners')
                    ->with('msg-fail', 'Unable to save data!');
    }

    // Nomenclatures - Edit Partners (POST)
    public function postPartnersEdit($id)
    {
        $messages = array(
            'min' => 'The :attribute field is required.',
        );

        $validator = Validator::make(Input::all(), array(
            'short_name' => 'required|max:32',
            'full_name' => 'max:255',
            'country' => 'numeric|min:1',
            'mail' => 'email'
        ), $messages);

        if ($validator->fails()) {
            return Redirect::route('nomenclatures-partners-edit',
                array('id' => $id))->withErrors($validator)->withInput();
        } else {
            $partner = Partner::where('id', $id)->take(1)->first();
            $partner->short_name = Input::get('short_name');
            $partner->full_name = Input::get('full_name');
            $partner->mol = Input::get('mol');
            $partner->country = Input::get('country');
            $partner->eic = Input::get('eic');
            $partner->vat = Input::get('vat');
            $partner->bank = Input::get('bank');
            $partner->bic = Input::get('bic');
            $partner->iban = Input::get('iban');
            $partner->address = Input::get('address');
            $partner->mail = Input::get('mail');
            $partner->phone = Input::get('phone');

            if ($partner->save()) {
                return Redirect::route('nomenclatures-partners')
                            ->with('msg-success', 'Data updated successfully!');
            }
        }

        return Redirect::route('nomenclatures-partners')
                    ->with('msg-fail', 'Unable to update data!');
    }

    // Nomenclatures - Get list of partners
    public static function getPartnersList()
    {
        return Partner::all();
    }

    /**
     *****************************   Categories   ******************************
     */
    // Nomenclatures - Categories (GET)
    public function getCategories()
    {
        $cats =  Cat::all()->toArray();
        return View::make('nomenclatures.categories', array(
            'title' => 'DANS ENERGY - Offices',
            'page' => 'nomenclatures',
            'cats' => $cats,
        ));
    }
    // Nomenclatures - Categories Edit (GET)
    public function getCategoriesEdit($id)
    {
        $cat = Cat::where('id', $id)->take(1);
        return View::make('nomenclatures.categories', array(
            'title' => 'DANS ENERGY - Edit Offices',
            'page' => 'nomenclatures',
            'cat' => $cat->first()
        ));
    }
    // Nomenclatures - Categories Delete (GET)
    public function getCategoriesDelete($id)
    {
        $cat = Cat::find($id);
        if($cat) {
            $cat->delete();
            return Redirect::route('nomenclatures-categories')
                ->with('msg-success', 'Data deleted successfully!');
        }
        return Redirect::route('nomenclatures-categories')
            ->with('msg-fail', 'Unable to delete category!');
    }
    // Nomenclatures - Categories (POST)
    public function postCategories()
    {
        $messages = array(
            'min' => 'The :attribute field is required.',
        );

        $validator = Validator::make(Input::all(), array(
            'name' => 'required|unique:cats|max:20',
            'type' => 'numeric|min:0',
            'access' => 'numeric|min:1',
            'desc' => ''
        ), $messages);

        if ($validator->fails()) {
            return Redirect::route('nomenclatures-categories')
                    ->withErrors($validator)->withInput();
        } else {
            $cat = new Cat();
            $cat->name = Input::get('name');
            $cat->type = Input::get('type');
            $cat->access = Input::get('access');
            $cat->desc = Input::get('desc');

            if ($cat->save()) {
                return Redirect::route('nomenclatures-categories')
                        ->with('msg-success', 'Data saved successfully!');
            }
        }

        return Redirect::route('nomenclatures-categories')
                    ->with('msg-fail', 'Unable to save data!');
    }
    // Nomenclatures - Edit Categories (POST)
    public function postCategoriesEdit($id)
    {
        $messages = array(
            'min' => 'The :attribute field is required.',
        );

        $validator = Validator::make(Input::all(), array(
            'name' => 'required|max:20',
            'type' => 'numeric|min:0',
            'access' => 'numeric|min:0',
            'desc' => ''
        ), $messages);

        if ($validator->fails()) {
            return Redirect::route('nomenclatures-categories-edit',
                    array('id' => $id))->withErrors($validator)->withInput();
        } else {
            $cat = Cat::where('id', $id)->take(1)->first();
            $cat->name = Input::get('name');
            $cat->type = Input::get('type');
            $cat->access = Input::get('access');
            $cat->desc = Input::get('desc');

            if ($cat->save()) {
                return Redirect::route('nomenclatures-categories')
                ->with('msg-success', 'Data updated successfully!');
            }
        }

        return Redirect::route('nomenclatures-categories')
        ->with('msg-fail', 'Unable to update data!');
    }

    public static function getCatsList()
    {
        return Cat::all();
    }
    /**
     ******************************   Operators   ******************************
     */
    // Nomenclatures - Operators (GET)
    public function getOperators()
    {
        $operators =  User::where('username', '!=', 'admin')->get();

        if(Config::get('maps.access.' .
                        Auth::user()->access) != 'Administrator') {
            return Redirect::route('overview');
        }

        return View::make('nomenclatures.operators', array(
            'title' => 'DANS ENERGY - Offices',
            'page' => 'nomenclatures',
            'operators' => $operators
        ));
    }
    // Nomenclatures - Operators Edit (GET)
    public function getOperatorsEdit($id)
    {
        if(Config::get('maps.access.' .
                Auth::user()->access) != 'Administrator') {
            return Redirect::route('overview');
        }
        $operator = User::where('id', $id)->take(1);
        return View::make('nomenclatures.operators', array(
            'title' => 'DANS ENERGY - Edit  Offices',
            'page' => 'nomenclatures',
            'operator' => $operator->first()
        ));
    }
    // Nomenclatures - Categories Delete (GET)
    public function getOperatorsDelete($id)
    {
        $operator = User::find($id);
        if($operator) {
            $operator->delete();
            return Redirect::route('nomenclatures-operators')
            ->with('msg-success', 'Data deleted successfully!');
        }
        return Redirect::route('nomenclatures-operators')
            ->with('msg-fail', 'Unable to delete the operator!');
    }
    // Nomenclatures - Operators (POST)
    public function postOperators()
    {
        $messages = array(
            'min' => 'The :attribute field is required.',
        );

        $validator = Validator::make(Input::all(), array(
            'username' => 'required|unique:users|max:30|min:3',
            'password' => 'required',
            'password_again' => 'required|same:password',
            'email' => 'required|email|max:60',
            'name' => 'required|min:3|max:20',
            'last_name' => 'required|min:3|max:20',
            'access' => 'required|numeric|min:1'
        ), $messages);

        if ($validator->fails()) {
            return Redirect::route('nomenclatures-operators')
            ->withErrors($validator)->withInput();
        } else {
            $operator = new User();
            $operator->username = Input::get('username');
            $operator->password = Hash::make(Input::get('password'));
            $operator->email = Input::get('email');
            $operator->name = Input::get('name');
            $operator->last_name = Input::get('last_name');
            $operator->access = Input::get('access');

            if ($operator->save()) {
                return Redirect::route('nomenclatures-operators')
                ->with('msg-success', 'Data saved successfully!');
            }
        }

        return Redirect::route('nomenclatures-operators')
        ->with('msg-fail', 'Unable to save data!');
    }
    // Nomenclatures - Edit Operators (POST)
    public function postOperatorsEdit($id)
    {
        $messages = array(
            'min' => 'The :attribute field is required.',
        );

        $validator = Validator::make(Input::all(), array(
            'access' => 'numeric|min:0',
            'ban' => 'numeric|min:0'
        ), $messages);

        if ($validator->fails()) {
            return Redirect::route('nomenclatures-operators-edit',
                array('id' => $id))->withErrors($validator)->withInput();
        } else {
            $operator = User::where('id', $id)->take(1)->first();
            $operator->access = Input::get('access');
            $operator->ban = Input::get('ban');

            if ($operator->save()) {
                return Redirect::route('nomenclatures-operators')
                ->with('msg-success', 'Data updated successfully!');
            }
        }

        return Redirect::route('nomenclatures-operators')
        ->with('msg-fail', 'Unable to update data!');
    }
}