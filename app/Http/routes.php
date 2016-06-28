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

Route::get('/', 'HomeController@index');

Route::group(['middleware'=>'cors', 'prefix'=>'api/v1'], function(){
    Route::resource('actors', 'ActorsController');
    Route::resource('countries', 'CountriesController');
    Route::get('countries/{id}/cities', 'CountriesController@cities');
    Route::resource('cities', 'CitiesController');
    Route::resource('addresses', 'AddressesController');
    Route::resource('languages', 'LanguagesController');
    Route::resource('films', 'FilmsController');
    Route::resource('categories', 'CategoriesController');
    Route::resource('stores', 'StoresController');
    Route::resource('inventories', 'InventoriesController');
    Route::resource('rentals', 'RentalsController');

});
