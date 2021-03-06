<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Route::get('/listing/{listing}', function (App/Listing $listing) {
//    $model = $listing->toArray();
//    return view('app', [ 'model' => $model ]);
//});

Route::get('/listing/{listing}', 'ListingController@get_listing_web');
Route::get('/', 'ListingController@get_home_web');