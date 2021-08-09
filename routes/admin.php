<?php

use App\Http\Controllers\Admin\LangugeController;
use App\Models\MainCategorie;
use App\Models\SubCategorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




define('PAGNATION_COUNT', 10);
Route::group(['namespace' => 'Admin', 'middleware' => 'auth:admin'], function () {

   Route::get('/', 'DashboardController@index')->name('admin.dashboard');

   #################### bigen languge  #################################

   Route::group(['prefix' => 'languages'], function () {

      Route::resource('languge', 'LangugeController', [
        'names' => [
            'index' => 'admin.languges',
            'create' => 'admin.languges.create',
            'store' => 'admin.languges.store',
            'edit' => 'admin.languges.edit',
            'update' => 'admin.languges.update',
            'destroy' => 'admin.languges.delete',
         ]

      ]);
   });

   #################### end languge  #################################



   #################### bigin main-categrys  #################################
   Route::group(['prefix' => 'main-categrys'], function () {

      Route::resource('cstegory', 'MainCategorieController', [

         'names' => [
            'index' => 'admin.cstegorys',
            'show'=>   'admin.cstegorys.show',
            'create' => 'admin.cstegorys.create',
            'store' => 'admin.cstegorys.store',
            'edit' => 'admin.cstegorys.edit',
            'update' => 'admin.cstegorys.update',
            'destroy' => 'admin.cstegorys.delete',
         ]

      ]);
   });

   #################### end main-categrys  #################################



   
   #################### bigin sub-categrys  #################################
   Route::group(['prefix' => 'sub-categrys'], function () {

      Route::resource('sub-cstegory', 'SubCategorieController', [

         'names' => [
            'index' => 'admin.sub-cstegorys',
            'create' => 'admin.sub-cstegorys.create',
            'store' => 'admin.sub-cstegorys.store',
            'edit' => 'admin.sub-cstegorys.edit',
            'update' => 'admin.sub-cstegorys.update',
            'destroy' => 'admin.sub-cstegorys.delete',
         ]

      ]);
   });

   #################### end sub-categrys  #################################




   #################### bigin vendor  #################################
   Route::group(['prefix' => 'vendors'], function () {

      Route::resource('vendor', 'VendorController', [

         'names' => [
            'index' => 'admin.vendors',
            'create' => 'admin.vendors.create',
            'store' => 'admin.vendors.store',
            'edit' => 'admin.vendors.edit',
            'update' => 'admin.vendors.update',
            'destroy' => 'admin.vendors.delete',
         ]

      ]);
   });


   #################### end vendor #################################


});




################################# Auth Admin ###############################


Route::group(['namespace' => 'Admin'], function () {

   Route::get('login', 'LoginController@getLogin')->name('get.admin.login');

   Route::post('getlogin', 'LoginController@Login')->name('admin.login');

   Route::post('logout', 'LoginController@logout')->name('admin.logout');
});

################################### end Auth Admin#################









################################### bign test #################
/*
Route::get('sub-category',function(){
  
   $subcategory=MainCategorie::with(['Subctegorys'=>function($qe){
      return $qe->where('translation_of',1);
   }])->find(1);
   return $subcategory;
});

Route::get('main-category',function(){
  
   $maincategory=SubCategorie::find(4)->mainCategory()->get();
   return MainCategorie::find( $maincategory[0]['id'])->categorys()->get();
  
});

*/
################################### end test #################

