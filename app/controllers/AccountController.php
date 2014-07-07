<?php
class AccountController extends BaseController
{
    /**
     ********************************* Account *********************************
     */
    /*============================ Account - Sign In =========================*/
    // Account - Sign In (GET)
    public function getSignIn()
    {
        return View::make('account.signin', array(
            'title' => 'DANS ENERGY - Sign In',
            'page' => 'signin',
        ));
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

            if (Auth::user()->ban > 0) {
                Auth::logout();
                return Redirect::route('account-sign-in')->with('msg',
                                    'This Account is blocked!');
            }

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

    /*============================ Account - Sign Out ========================*/
    // Account - Sign Out (GET)
    public function getSignOut()
    {
        Auth::logout();
        return Redirect::route('account-sign-in');
    }

    /**
     ********************************* Profile *********************************
     */
    // Profile - (GET)
    public function getProfile()
    {
        return View::make('account.profile', array(
            'title' => 'DANS ENERGY - Profile',
            'page' => 'profile',
            'me' => Auth::user())
        );
    }
    // Profile - (POST)
    public function postProfile()
    {

        $newPass = false;
        $rules = array(
            'name' => 'required',
            'last_name' => 'required|min:2',
            'email' => 'required|email',
            'old_password' => 'required'
        );

        if (strlen(Input::get('password')) > 0 ) {
            $rules['password'] = 'required|min:6';
            $rules['password_again'] = 'required|min:6|same:password';
            $newPass = true;
        }

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {
            $user = User::find(Auth::user()->id);
            if (Hash::check(Input::get('old_password'),
                    $user->getAuthPassword())) {

                if ($newPass) {
                    $user->password = Hash::make(Input::get('password'));
                }
                $user->name = Input::get('name');
                $user->last_name = Input::get('last_name');
                $user->email = Input::get('email');

                if ($user->save()) {
                    return Redirect::route('profile')
                        ->with('msg-success', 'Data saved successfully!');
                }
            } else {
                return Redirect::route('profile')->withInput()
                            ->withErrors($validator)
                            ->with('msg-fail', 'Incorect password!');
            }
        } else {
            return Redirect::route('profile')->withInput()
                        ->withErrors($validator);
        }

        return Redirect::route('profile')->withInput()
                        ->with('msg-fail', 'Unable to save data!');

    }
}