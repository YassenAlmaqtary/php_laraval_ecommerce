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
 

 ################# start product ###############
 Route::resource('product', 'ProdcutControllerProduct',[
  
   'names' => [
      'index'=>'vendor.product.index',
      'create' => 'vendor.product.create',
      'store' => 'vendor.product.store',
      'edit' => 'vendor.product.edit',
      'update' => 'vendor.product.update',
      'destroy' => 'vendor.product.delete',
      ] 
 ]);



 ################# enid product ###############



});



################################# Auth vendor ###############################


Route::group(['namespace'=>'Vendor'], function () {

   Route::get('login', 'VendorLoginController@getLogin')->name('get.vendor.login');

   Route::post('getlogin','VendorLoginController@Login')->name('vendor.login');

   Route::post('logout', 'VendorLoginController@logout')->name('vendor.logout');
});

###################################end Auth vendor #################

  
 

