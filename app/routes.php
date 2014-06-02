<?php
/**
 * ************************* Authenticated group *******************************
 */
Route::group(array('before' => 'auth'), function() {

    /*==============================   Home   ================================*/
    // Home (GET)
    Route::get ( '/', array(
        'as' => 'home',
        'uses' => 'HomeController@home'
    ));

    /*=============================   Account   ==============================*/
    // Account - Sign Out (GET)
    Route::get('/account/signout', array(
        'as' => 'account-sign-out',
        'uses' => 'AccountController@getSignOut'
    ));

    /*==========================   Nomenclatures   ===========================*/
    /***   ---Offices---   ***/
    // Nomenclatures - Offices (GET)
    Route::get('/nomenclatures/offices', array(
        'as' => 'nomenclatures-offices',
        'uses' => 'NomenclaturesController@getOffices'
    ));
    // Nomenclatures - Edit Office {GET}
    Route::get('nomenclatures/offices/edit/{id}', array(
        'as' => 'nomenclatures-offices-edit',
        'uses' => 'NomenclaturesController@getOfficesEdit'
    ));
    // Nomenclatures - Edit Office {GET}
    Route::get('nomenclatures/offices/delete/{id}', array(
        'as' => 'nomenclatures-offices-delete',
        'uses' => 'NomenclaturesController@getOfficesDelete'
    ));
    /*------------------------------------------------------------------------*/
    /***   ---Categories---   ***/
    // Nomenclatures - Categories (GET)
    Route::get('/nomenclatures/categories', array(
        'as' => 'nomenclatures-categories',
        'uses' => 'NomenclaturesController@getCategories'
    ));
    // Nomenclatures - Operators (GET)
    Route::get('/nomenclatures/operators', array(
        'as' => 'nomenclatures-operators',
        'uses' => 'NomenclaturesController@getOperators'
    ));

    /*** CSRF protection ***/
    Route::group(array('before' => 'csrf'), function(){
        // Nomenclatures - Offices (POST)
        Route::post('/nomenclatures/offices', array(
            'as' => 'nomenclatures-offices-post',
            'uses' => 'NomenclaturesController@postOffices'
        ));
        // Nomenclatures - Edit Offices (POST)
        Route::post('/nomenclatures/offices/edit/{id}', array(
            'as' => 'nomenclatures-offices-edit-post',
            'uses' => 'NomenclaturesController@postOfficesEdit'
        ));
    });

    /*=============================   Reports   ==============================*/
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