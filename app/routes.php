<?php



/**
 * ************************* Authenticated group *******************************
 */
Route::group(array('before' => 'auth'), function() {
    Route::get ( '/', array(
        'as' => 'home',
        'uses' => 'HomeController@home'
    ));
});

/**
 * ************************ Unauthenticated group ******************************
 */

Route::group(array('before' => 'guest'), function() {
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