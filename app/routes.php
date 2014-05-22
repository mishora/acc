<?php
/**
 * ************************* Authenticated group *******************************
 */
Route::group(array('before' => 'auth'), function() {
    // Home (GET)
    Route::get ( '/', array(
        'as' => 'home',
        'uses' => 'HomeController@home'
    ));

    /*=============================   Account   =============================*/

    // Account - Sign Out (GET)
    Route::get('/account/signout', array(
        'as' => 'account-sign-out',
        'uses' => 'AccountController@getSignOut'
    ));
});

/**
 * ************************ Unauthenticated group ******************************
 */

Route::group(array('before' => 'guest'), function() {
    /* CSRF protection */
    Route::group(array('before' => 'csrf'), function() {
        // Account - sign in (POST)
        Route::post('/account/signin', array(
            'as' => 'account-sign-in-post',
            'uses' => 'AccountController@postSignIn'
        ));
    });

    // Account - sign in (GET)
    Route::get('/account/signin', array(
        'as' => 'account-sign-in',
        'uses' => 'AccountController@getSignIn'
    ));
});