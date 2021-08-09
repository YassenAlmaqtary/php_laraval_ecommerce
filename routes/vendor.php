<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace'=>'Vendor'], function () {

  
 Route::get('/','VendorControllerVendor@index')->name('vendor.vendors');
 
 ################# bigin vendor ###############

 Route::group(['prefix' => 'vendors'], function () {

   Route::resource('vendor', 'VendorControllerVendor', [

      'names' => [
         'create' => 'vendor.vendors.create',
         'store' => 'vendor.vendors.store',
         'edit' => 'vendor.vendors.edit',
         'update' => 'vendor.vendors.update',
         'destroy' => 'vendor.vendors.delete',
     
         ] 
       ]);
   
  });

 ################# enid vendor ###############


});



################################# Auth vendor ###############################


Route::group(['namespace'=>'Vendor'], function () {

   Route::get('login', 'VendorLoginController@getLogin')->name('get.vendor.login');

   Route::post('getlogin','VendorLoginController@Login')->name('vendor.login');

   Route::post('logout', 'VendorLoginController@logout')->name('vendor.logout');
});

###################################end Auth vendor #################

  
 

