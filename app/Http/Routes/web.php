<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/',              'HomeController@index');
Route::get('/index.php',     'HomeController@index');

Route::get('/locale/{lang}', 'HomeController@locale');

/**
 * Auth
 */
Route::group(['prefix' => 'auth'], function ()
{
    Route::group(['middleware' => 'guest'], function ()
    {
        Route::get ('/login',     'AuthController@login');
        Route::get ('/register',  'AuthController@register');
        Route::get ('/forgot',    'AuthController@forgot');
        Route::get ('/reset',     'AuthController@reset');
    });

    Route::any('/logout',         'AuthController@logout');
    Route::any('/captcha',        'AuthController@captcha');

    Route::post('/login',         'AuthController@handleLogin');
    Route::post('/register',      'AuthController@handleRegister');
    Route::post('/forgot',        'AuthController@handleForgot');

    Route::post('/reset',         'AuthController@handleReset');
});

/**
 * User Center
 */
Route::group(['middleware' => 'auth', 'prefix' => 'user'], function ()
{
    Route::any ('',                      'UserController@index');
    Route::any ('/sign-in',              'UserController@signIn');

    // Profile
    Route::get ('/profile',              'UserController@profile');
    Route::post('/profile',              'UserController@handleProfile');
    Route::post('/profile/avatar',       'UserController@setAvatar');

    // Player
    Route::any ('/player',               'PlayerController@index');
    Route::post('/player/add',           'PlayerController@add');
    Route::post('/player/show',          'PlayerController@show');
    Route::post('/player/preference',    'PlayerController@setPreference');
    Route::post('/player/set',           'PlayerController@setTexture');
    Route::post('/player/texture',       'PlayerController@changeTexture');
    Route::post('/player/texture/clear', 'PlayerController@clearTexture');
    Route::post('/player/rename',        'PlayerController@rename');
    Route::post('/player/delete',        'PlayerController@delete');

    // Closet
    Route::get ('/closet',               'ClosetController@index');
    Route::get ('/closet-data',          'ClosetController@getClosetData');
    Route::post('/closet/add',           'ClosetController@add');
    Route::post('/closet/remove',        'ClosetController@remove');
    Route::post('/closet/rename',        'ClosetController@rename');
});

/**
 * Skin Library
 */
Route::group(['prefix' => 'skinlib'], function ()
{
    Route::get ('',                   'SkinlibController@index');
    Route::any ('/info/{tid}',        'SkinlibController@info');
    Route::any ('/show/{tid}',        'SkinlibController@show');
    Route::any ('/search',            'SkinlibController@search');

    Route::group(['middleware' => 'auth'], function ()
    {
        Route::get ('/upload',        'SkinlibController@upload');
        Route::post('/upload',        'SkinlibController@handleUpload');

        Route::post('/rename',        'SkinlibController@rename');
        Route::post('/privacy',       'SkinlibController@privacy');
        Route::post('/delete',        'SkinlibController@delete');
    });
});

/**
 * Admin Panel
 */
Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function ()
{
    Route::get('/',            'AdminController@index');

    Route::any('/customize',   'AdminController@customize');
    Route::any('/score',       'AdminController@score');
    Route::any('/options',     'AdminController@options');

    Route::get('/users',       'AdminController@users');
    Route::get('/user-data',   'AdminController@getUserData');

    Route::get('/players',     'AdminController@players');
    Route::get('/player-data', 'AdminController@getPlayerData');
    Route::get('/user/{uid}',  'AdminController@getOneUser');

    // ajax handlers
    Route::post('/users',      'AdminController@userAjaxHandler');
    Route::post('/players',    'AdminController@playerAjaxHandler');

    Route::group(['prefix' => 'plugins'], function () {
        Route::get ('/data',   'PluginController@getPluginData');
        Route::any ('/market', 'PluginController@showMarket');

        Route::get ('/manage', 'PluginController@showManage');
        Route::post('/manage', 'PluginController@manage');
        Route::any ('/config/{name}', 'PluginController@config');
    });

    Route::group(['prefix' => 'update'], function () {
        Route::any('',          'UpdateController@showUpdatePage');
        Route::get('/check',    'UpdateController@checkUpdates');
        Route::any('/download', 'UpdateController@download');
    });
});
