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


Route::get('/', function () {
  
  return view('frontEnd.index');
   // return view('frontEnd.page-login');

})->name('frontEnd.index');

Route::get('/page-login', function () {
  return view('frontEnd.page-login');
})->name('client-login');

Route::get('/marquee-request', function () {
  return view('frontEnd.marquee-request');
})->name('marquee-regist');

// Route::get('/userprofile', function () {
//   return view('frontEnd.userprofile');
// })->name('userprofile');

Route::get('/page-signup', function () {
  return view('frontEnd.page-signup');
});

Route::get('logout', 'Auth\LoginController@logout', function () {
    return abort(404);
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('IsAdmin');


Route::get('verify/resend', 'Auth\TwoFactorController@resend')->name('verify.resend');
Route::resource('verify', 'Auth\TwoFactorController')->only('index','store');


	// UserManagement Routes
	// ======== Athuntication ========== //
	// UserManagement Module Require To Access this group Routes
	Route::group([ 'namespace' => 'UserManagement', 'prefix' => 'UserManagement', 'middleware' => ['auth', 'twofactor']], function () {

    Route::get('/', 'UserManagementController@index')->name('usermanagement.index');
		// User CRUD Routes
		Route::resource('users', 'UserController');
    Route::get('change-password','UserController@ChangePassword')->name('password.change');
    Route::post('change-password','UserController@UpdatePassword')->name('password.update');
    Route::put('users/status/{id}', 'UserController@toggleStatus')->name('users.toggleStatus');

    // // User Groups CRUD Routes
    Route::resource('usergroups', 'UserGroupController');
    Route::put('usergroups/status/{id}', 'UserGroupController@toggleStatus')->name('usergroups.toggleStatus');
	});

Route::resource('clients', 'ClientManagement\ClientController');

Route::post('client/login', 'ClientManagement\ClientController@login')->name('client.login');
Route::get('client/logout', 'ClientManagement\ClientController@logout')->name('client.logout');

Route::resource('marquees', 'MarqueeManagement\MarqueeController');

Route::post('marquees/request', 'MarqueeManagement\MarqueeController@marqueerequest')->name('marq-request');
Route::get('userprofile/{id}', 'MarqueeManagement\MarqueeController@userprofile')->name('userprofile');
Route::put('marquees/status/{id}', 'MarqueeManagement\MarqueeController@toggleStatus')->name('marquees.toggleStatus');
Route::resource('services', 'MarqueeManagement\ServiceController');
Route::get('Services/addService/{id}', 'MarqueeManagement\ServiceController@addservice')->name('addservice');
Route::resource('gallerys', 'MarqueeManagement\ImageUploadController');
Route::get('gallerys/addimage/{id}', 'MarqueeManagement\ImageUploadController@addimage')->name('addimage');
Route::POST('gallerys/storeimage', 'MarqueeManagement\ImageUploadController@storeimage')->name('storeimage');

Route::post('deleteimage','MarqueeManagement\ImageUploadController@fileDestroy')->name('deleteimage');

// Route::post('image/upload/store','MarqueeManagement\ImageUploadControllerr@fileStore');

Route::resource('city', 'MarqueeManagement\CityController');

Route::group([ 'namespace' => 'FrontEnd', 'prefix' => 'frontEnd'], function () {

    // Route::get('/', 'UserManagementController@index')->name('usermanagement.index');
    
    Route::resource('cities', 'CityController')->only('index', 'show');
    
    Route::get('marquee-detail/{id}', 'CityController@marqueeDetail')->name('marquee_detail');


    Route::resource('marquee.menu', 'MenuController');

    Route::resource('menu.dishes', 'DishesController');

    Route::resource('booking', 'MarqueeBookingController')->only('index','store', 'show', 'destroy');
    Route::post('clientuser','MarqueeBookingController@userstore')->name('frontclient-add');

    Route::put('booking/marqueeStatus/{id}/{status}',[
      'uses' => 'MarqueeBookingController@marqueeStatus',
      'as' => 'booking.marqueeStatus',
    ])->where(['id' => '[0-9]+', 'status' => '[a-z]+']);

  });


