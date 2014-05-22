<?php
class AccountController extends BaseController
{
    /**
     ************************** Account - Sign In *****************************
     */
    // Account - Sign In (GET)
    public function getSignIn()
    {
        return View::make('account.signin');
    }

    // Account - Sign In (POST)
    public function postSignIn() {
        $validator = Validator::make(Input::all(), array(
            'username' => 'required',
            'password' => 'required'
        ));

        if ($validator->fails()) {
            return Redirect::route('account-sign-in')
                ->withErrors($validator)->withInput();
        } else {
            $auth = Auth::attempt(array(
                'username' => Input::get('username'),
                'password' => Input::get('password')
            ));

            if ($auth) {
                return Redirect::intended('/');
            } else {
                return Redirect::route('account-sign-in')->with('msg',
                    'Username or password incorect!');
            }
        }

        return Redirect::route('account-sign-in')->with('msg',
                'There was a problem signing you in!');
    }
}