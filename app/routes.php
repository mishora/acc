<?php
/**
 * ************************* Authenticated group *******************************
 */
Route::group(array('before' => 'auth'), function() {

    /*============================   Overview   ==============================*/
    // Overview (GET)
    Route::get ( '/', array(
        'as' => 'overview',
        'uses' => 'OverviewController@getOverview'
    ));

    // Overview (GET)
    Route::get ( '/overview', function() {
        return Redirect::route('overview');
    });

    // Mark (GET)
    Route::get ('/mark', function() {
        return Redirect::route('overview');
    });

    /*=============================   Items   ==============================*/
    // Items (GET)
    Route::get ( '/add', array(
        'as' => 'add',
        'uses' => 'ItemsController@getAdd'
    ));
    // Item delete - Delete Item (GET)
    Route::get('/delete/{id}', array(
        'as' => 'items-delete',
        'uses' => 'ItemsController@getItemsDelete'
    ));
    // Nomenclatures - Edit Item {GET}
    Route::get('/{id}', array(
        'as' => 'items-edit',
        'uses' => 'ItemsController@getItemsEdit'
    ));

    /*=============================   Account   ==============================*/
    // Account - Sign Out (GET)
    Route::get('/account/signout', array(
        'as' => 'account-sign-out',
        'uses' => 'AccountController@getSignOut'
    ));
    // Account - Profile (GET)
    Route::get('/account/profile', array(
        'as' => 'account-profile',
        ''
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
    // Nomenclatures - Delete Office {GET}
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
    // Nomenclatures - Edit Cat {GET}
    Route::get('nomenclatures/categories/edit/{id}', array(
    'as' => 'nomenclatures-categories-edit',
    'uses' => 'NomenclaturesController@getCategoriesEdit'
        ));
    // Nomenclatures - Delete Cat {GET}
    Route::get('nomenclatures/categories/delete/{id}', array(
        'as' => 'nomenclatures-categories-delete',
        'uses' => 'NomenclaturesController@getCategoriesDelete'
    ));

    /*------------------------------------------------------------------------*/
    /***   ---Operators---   ***/
    // Nomenclatures - Operators (GET)
    Route::get('/nomenclatures/operators', array(
        'as' => 'nomenclatures-operators',
        'uses' => 'NomenclaturesController@getOperators'
    ));
    // Nomenclatures - Edit Operator {GET}
    Route::get('nomenclatures/operators/edit/{id}', array(
        'as' => 'nomenclatures-operators-edit',
        'uses' => 'NomenclaturesController@getOperatorsEdit'
    ));
    // Nomenclatures - Delete Operator {GET}
    Route::get('nomenclatures/operators/delete/{id}', array(
        'as' => 'nomenclatures-operators-delete',
        'uses' => 'NomenclaturesController@getOperatorsDelete'
    ));

    /*=============================   Profile   ==============================*/
    // Profile - (GET)
    Route::get('/profile', array(
        'as' => 'profile',
        'uses' => 'AccountController@getProfile'
    ));

    /*============================   CSRF   ==================================*/

    /*** CSRF protection ***/
    Route::group(array('before' => 'csrf'), function(){
        /*--------------------------   Overview   ----------------------------*/
        // Mark (POST)
        Route::post( '/mark', array(
            'as' => 'mark',
            'uses' => 'OverviewController@postMark'
        ));

        Route::post('/overview', array(
            'as' => 'overview-filters',
            'uses' => 'OverviewController@postOverviewFilters'
        ));

        /*---------------------------   Items   ----------------------------*/
        // Items (POST)
        Route::post( '/add{id?}', array(
            'as' => 'items-post',
            'uses' => 'ItemsController@postItemsAdd'
        ));
        /*------------------------   Nomenclatures   -------------------------*/
        // Nomenclatures - Offices (POST)
        Route::post('/nomenclatures/offices', array(
            'as' => 'nomenclatures-offices-post',
            'uses' => 'NomenclaturesController@postOffices'
        ));
        // Nomenclatures - Offices Edit (POST)
        Route::post('/nomenclatures/offices/edit/{id}', array(
            'as' => 'nomenclatures-offices-edit-post',
            'uses' => 'NomenclaturesController@postOfficesEdit'
        ));
        // Nomenclatures - Categories (POST)
        Route::post('/nomenclatures/categories', array(
            'as' => 'nomenclatures-categories-post',
            'uses' => 'NomenclaturesController@postCategories'
        ));
        // Nomenclatures - Categories Edit (POST)
        Route::post('/nomenclatures/categories/edit/{id}', array(
            'as' => 'nomenclatures-categories-edit-post',
            'uses' => 'NomenclaturesController@postCategoriesEdit'
        ));
        // Nomenclatures - Operators (POST)
        Route::post('/nomenclatures/operators', array(
            'as' => 'nomenclatures-operators-post',
            'uses' => 'NomenclaturesController@postOperators'
        ));
        // Nomenclatures - Categories Edit (POST)
        Route::post('/nomenclatures/operators/edit/{id}', array(
            'as' => 'nomenclatures-operators-edit-post',
            'uses' => 'NomenclaturesController@postOperatorsEdit'
        ));
        /*---------------------------   Profile   ----------------------------*/
        Route::post('/profile_edit', array(
            'as' => 'profile-edit',
            'uses' => 'AccountController@postProfile'
        ));
    });

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