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




Auth::routes();

//Route::get('/dashboard', 'DashboardController@index');
//// Route::get('/system-management/{option}', 'SystemMgmtController@index');
//Route::get('/profile', 'ProfileController@index');

Route::group(['middleware' => ['web', 'auth']], function(){
    Route::get('/', function () {
        if(Auth::user()->level == 1){
            return view('dashboard');
        } elseif (Auth::user()->level == 2) {
            return view('sourcingHome');
        }
    });

    Route::post('user-management/search', 'UserManagementController@search')->name('user-management.search');
    Route::resource('user-management', 'UserManagementController');

    Route::post('customer-management/search', 'CustomerManagementController@search')->name('customer-management.search');
    Route::resource('customer-management', 'CustomerManagementController');

    Route::post('vendor-management/search', 'VendorManagementController@search')->name('vendor-management.search');
    Route::resource('vendor-management', 'VendorManagementController');

    Route::post('fish-management/search', 'FishManagementController@search')->name('fish-management.search');
    Route::resource('fish-management', 'FishManagementController');

    Route::get('flocation-management/listData', 'FLocationManagementController@listData')->name('flocation-management.listData');
    Route::resource('flocation-management', 'FLocationManagementController');

    Route::resource('slocation-management', 'SLocationManagementController');
    //Route::post('slocation-management/state/search', 'SLocationManagementController@search')->name('slocation.search');

    Route::resource('warehouse-management', 'WarehouseManagementController');
    //Route::post('slocation-management/state/search', 'SLocationManagementController@search')->name('slocation.search');

    Route::resource('measurement-management', 'MeasurementManagementController');

    Route::resource('purchase-proposal', 'PurchaseProposalController');
//    Route::get('purchase-proposal/create/{id}', 'PurchaseProposalController@test')->name('purchase-proposal.create.id');
    Route::get('purchase-proposal/create/{id}','PurchaseProposalController@test');

    Route::post('sourcing-dashboard/search', 'SourcingDashboardController@search')->name('sourcing-dashboard.search');
    Route::resource('sourcing-dashboard', 'SourcingDashboardController');

});

