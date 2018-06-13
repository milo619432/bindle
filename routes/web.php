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
    return view('layouts.login');
})->name('layouts.login');

Route::get('/home', function(){
    return view('layouts.login');
})->name('home');

Route::get('/dash', function () {    
    return view('layouts.main');
})->name('layouts.main');

//ajax call for users
Route::get('/issues/getUsers', 'issuesController@getUsers');

//ajax route to get customers
Route::get('/customers/allCustomers', 'customerController@getCustomers');

//ajax route to get all issues
Route::get('/issues/getIssues', 'issuesController@getIssues');

//ajax route for dash panels
Route::get('/dash/panels', 'issuesController@issuesStats');

//ajax route get all suppliers
Route::get('/suppliers/allSuppliers', 'suppliersController@getSuppliers');

//ajax route for single customer, to populate edit customer modal
Route::get('/customers/singleCustomer', 'customerController@getSingleCustomer');

//ajax route for editing issues
Route::get('/issues/editIssue', 'issuesController@getSingleIssue');

//ajax call to get single supplier
//Route::get('/suppliers/singleSupplier', 'suppliersController@getSingleSupplier');

Route::get('/admin', 'newUserController@getUsers')->name('layouts.admin');

Route::get('holidays', function(){
    return view('layouts.holiday');
})->name('holiday');

Route::get('/customers' ,function(){
 return view('layouts.customermenu')   ;
})->name('layouts.customermenu');

Route::get('/issues', function() {
   return view ('layouts.issues');
})->name('layouts.issues');

Route::get('/suppliers', function(){
    return view ('layouts.suppliers');
})->name('layouts.suppliers');
    

Route::get('/reports', function(){
   return view ('layouts.reports'); 
})->name('layouts.reports');

Route::get('/knowledgebase', function(){
    return view ('layouts.knowledgebase');
})->name('layouts.knowledgebase');

Route::get('/prospects', function(){
    return view ('layouts.prospects');
})->name('layouts.prospects');

Route::get('/notes', function(){
    Return view ('layouts.salesnotes');
})->name('layouts.salesnotes');

Route::get('/accounts', function(){
   return view('layouts.accounts');
})->name('layouts.accounts');

Route::get('/pulseoffice', function(){
   return view ('layouts.pulseofficeversiondata'); 
})->name('layouts.pulseofficeversiondata');

Route::get('/pulsestore', function(){
   return view ('layouts.pulsestore');
})->name('layouts.pulsestore');

Route::get('/pulsecloud', function(){
   return view ('layouts.pulsecloud');
})->name('layouts.pulsecloud');

Route::get('/wishlist', function(){
   return view('layouts.wishlist');
})->name('layouts.wishlist');

Route::post('/newUser', 'newUserController@setNewUser');

Route::post('/editUser', 'newUserController@editUser');

Route::post('/login', 'loginController@logUserIn');

Route::post('/uploadCustomers', 'customerController@importCustomers');

Route::get('/logout', 'loginController@logOut');

Route::get('/deleteUser', 'newUserController@deleteUser');

Route::get('/activateUser', 'newUserController@activateUser');

Route::post('/addCustomer', 'customerController@addSingleCustomer');

Route::post('/addIssue', 'issuesController@addIssue');

Route::post('/editCustomer', 'customerController@editCustomer');

Route::post('/editIssue', 'issuesController@editIssue');

Route::post('/addSupplier', 'suppliersController@addSupplier');