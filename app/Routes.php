<?php
/**
 * Routes - all standard Routes are defined here.
 *
 * @author David Carr - dave@daveismyname.com
 * @author Virgil-Adrian Teaca - virgil@giulianaeassociati.com
 * @version 3.0
 */

// The default Auth Routes.
Route::get('login',  array(
    'before' => 'guest',
    'uses' => 'App\Controllers\Admin\Authorize@login'
));

Route::post('login', array(
    'before' => 'guest|csrf',
    'uses' => 'App\Controllers\Admin\Authorize@postLogin'
));

Route::get('logout', array(
    'before' => 'auth',
    'uses' => 'App\Controllers\Admin\Authorize@logout'
));

// The Password Remind.
Route::get('password/remind', array(
    'before' => 'guest',
    'uses' => 'App\Controllers\Admin\Authorize@remind'
));

Route::post('password/remind', array(
    'before' => 'guest|csrf',
    'uses' => 'App\Controllers\Admin\Authorize@postRemind'
));

// The Password Reset.
Route::get('password/reset(/{token})', array(
    'before' => 'guest',
    'uses' => 'App\Controllers\Admin\Authorize@reset'
));

Route::post('password/reset', array(
    'before' => 'guest|csrf',
    'uses' => 'App\Controllers\Admin\Authorize@postReset'
));

// The Account Registration.
Route::get('register', array(
    'before' => 'guest',
    'uses' => 'App\Controllers\Admin\Registrar@create'
));

Route::post('register', array(
    'before' => 'guest|csrf',
    'uses' => 'App\Controllers\Admin\Registrar@store'
));

Route::get('register/verify/{token}', array(
    'before' => 'guest',
    'uses' => 'App\Controllers\Admin\Registrar@verify'
));

Route::get('register/status', array(
    'before' => 'guest',
    'uses' => 'App\Controllers\Admin\Registrar@status'
));

// The Adminstration Routes.
Route::group(array('prefix' => 'admin', 'namespace' => 'App\Controllers\Admin'), function() {
    // The User's Profile.
    Route::get( 'users/profile', array('before' => 'auth',      'uses' => 'Users@profile'));
    Route::post('users/profile', array('before' => 'auth|csrf', 'uses' => 'Users@postProfile'));

    // The Users CRUD.
    Route::get( 'users',                array('before' => 'auth',      'uses' => 'Users@index'));
    Route::get( 'users/create',         array('before' => 'auth',      'uses' => 'Users@create'));
    Route::post('users',                array('before' => 'auth|csrf', 'uses' => 'Users@store'));
    Route::get( 'users/{id}',         array('before' => 'auth',      'uses' => 'Users@show'));
    Route::get( 'users/{id}/edit',    array('before' => 'auth',      'uses' => 'Users@edit'));
    Route::post('users/{id}',         array('before' => 'auth|csrf', 'uses' => 'Users@update'));
    Route::post('users/{id}/destroy', array('before' => 'auth|csrf', 'uses' => 'Users@destroy'));

    // The Users Search.
    Route::post( 'users/search', array('before' => 'auth', 'uses' => 'Users@search'));

    // The Roles CRUD.
    Route::get( 'roles',                array('before' => 'auth',      'uses' => 'Roles@index'));
    Route::get( 'roles/create',         array('before' => 'auth',      'uses' => 'Roles@create'));
    Route::post('roles',                array('before' => 'auth|csrf', 'uses' => 'Roles@store'));
    Route::get( 'roles/{id}',         array('before' => 'auth',      'uses' => 'Roles@show'));
    Route::get( 'roles/{id}/edit',    array('before' => 'auth',      'uses' => 'Roles@edit'));
    Route::post('roles/{id}',         array('before' => 'auth|csrf', 'uses' => 'Roles@update'));
    Route::post('roles/{id}/destroy', array('before' => 'auth|csrf', 'uses' => 'Roles@destroy'));

    // The Pages CRUD.
    Route::get( 'pages',                array('before' => 'auth',      'uses' => 'Pages@index'));
    Route::get( 'pages/create',         array('before' => 'auth',      'uses' => 'Pages@create'));
    Route::post('pages',                array('before' => 'auth|csrf', 'uses' => 'Pages@store'));
    Route::get( 'pages/{id}/edit',    array('before' => 'auth',      'uses' => 'Pages@edit'));
    Route::get( 'pages/restorerevision/{id}',    array('before' => 'auth',      'uses' => 'Pages@restoreRevision'));
    Route::post('pages/{id}',         array('before' => 'auth|csrf', 'uses' => 'Pages@update'));
    Route::post('pages/{id}/destroy', array('before' => 'auth|csrf', 'uses' => 'Pages@destroy'));
    Route::post('pages/pageblocks/{id}/destroy', array('before' => 'auth|csrf', 'uses' => 'Pages@destroyPageBlock'));
    Route::post('pages/updatepageblocks', array('before' => 'auth|csrf', 'uses' => 'Pages@updatePageBlocks'));

    //Global Blocks
    Route::get( 'globalblocks',                array('before' => 'auth',      'uses' => 'GlobalBlocks@index'));
    Route::post('globalblocks/{id}/destroy', array('before' => 'auth|csrf', 'uses' => 'GlobalBlocks@destroy'));
    Route::post('globalblocks/update', array('before' => 'auth|csrf', 'uses' => 'GlobalBlocks@update'));

    // The Sidebars CRUD.
    Route::get( 'sidebars',                array('before' => 'auth',      'uses' => 'Sidebars@index'));
    Route::get( 'sidebars/create',         array('before' => 'auth',      'uses' => 'Sidebars@create'));
    Route::post('sidebars',                array('before' => 'auth|csrf', 'uses' => 'Sidebars@store'));
    Route::get( 'sidebars/{id}/edit',    array('before' => 'auth',      'uses' => 'Sidebars@edit'));
    Route::post('sidebars/{id}',         array('before' => 'auth|csrf', 'uses' => 'Sidebars@update'));
    Route::post('sidebars/{id}/destroy', array('before' => 'auth|csrf', 'uses' => 'Sidebars@destroy'));

    Route::get( 'editor',                array('before' => 'auth',      'uses' => 'Editor@index'));
});

Route::group(array('prefix' => 'admin', 'namespace' => 'App\Controllers\Admin'), function() {
    Route::get( 'settings', array('before' => 'auth',      'uses' => 'Settings@index'));
    Route::post('settings', array('before' => 'auth|csrf', 'uses' => 'Settings@store'));
});

Route::get('admin(/dashboard)', array(
    'before' => 'auth',
    'uses' => 'App\Controllers\Admin\Dashboard@index'
));

// Route::catchAll('App\Controllers\Pages@fetch');
Route::any('{slug}', 'App\Controllers\Pages@fetch')->where('slug', '(.*)');

/** Define static routes. */

// The default Routing
Route::get('/',       'App\Controllers\Welcome@index');
Route::get('subpage', 'App\Controllers\Welcome@subPage');

// A catch-all Route - will match any URI, while using any HTTP Method.
//Route::any('{slug}', 'App\Controllers\Demo@catchAll')->where('slug', '(.*)');

/** End default Routes */
