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
      'show'=>'vendor.product.show',
      'destroy' => 'vendor.product.delete',
      ] 
 ]);

 ################# enid product ###############




 ################# start photos ###############
 Route::resource('photo', 'PhotosController',[
  
   'names' => [
      'index'=>'vendor.photo.index',
      'create' => 'vendor.photo.create',
      'store' => 'vendor.photo.store',
      'edit' => 'vendor.photo.edit',
      'update' => 'vendor.photo.update',
      'show'=>'vendor.photo.show',
      'destroy' => 'vendor.photo.delete',
      
      ] 
 ]);

 ################# enid photos ###############


 

 ################# start color ###############
 Route::resource('color', 'ColorController',[
  
   'names' => [
      'index'=>'vendor.color.index',
      'create' => 'vendor.color.create',
      'store' => 'vendor.color.store',
      'edit' => 'vendor.color.edit',
      'update' => 'vendor.color.update',
      'show'=>'vendor.color.show',
      'destroy' => 'vendor.color.delete',
      
      ] 
 ]);

 ################# enid color ###############




 ################# start size ###############
 Route::resource('size', 'SizeController',[
  
   'names' => [
      'index'=>'vendor.size.index',
      'create' => 'vendor.size.create',
      'store' => 'vendor.size.store',
      'edit' => 'vendor.size.edit',
      'update' => 'vendor.size.update',
      'show'=>'vendor.size.show',
      'destroy' => 'vendor.size.delete',
      
      ] 
 ]);

 ################# enid size ###############




});



################################# Auth vendor ###############################


Route::group(['namespace'=>'Vendor'], function () {

   Route::get('login', 'VendorLoginController@getLogin')->name('get.vendor.login');

   Route::post('getlogin','VendorLoginController@Login')->name('vendor.login');

   Route::post('logout', 'VendorLoginController@logout')->name('vendor.logout');
});

###################################end Auth vendor #################

  
 

