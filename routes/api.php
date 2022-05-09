<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/


Route::group(['namespace' => 'UserApi'], function () {
    ########################### bigin auth user #############################

    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
    Route::post('/logout', 'AuthController@logout');
    Route::post('/cheekToken', 'AuthController@cheekToken');
    Route::get('/profile-user','AuthController@profileUser')->middleware('assign.guard:api');
    Route::post('/updateProfile', 'AuthController@updateProfile');
    Route::post('/password/email', 'ForgotPasswordRequestController@sendResetLinkEmail')->middleware('cheeklang');;
    Route::post('/password/reset', 'ResetPasswordRequestController@reset')->middleware('cheeklang');
    

    ########################### end  auth user #############################

});



Route::group(['namespace' => 'FrontApi'], function () {
    ########################### bigin maincategorys#############################
    Route::get('/maincategorys', 'MainCategoryController@getAllCategory')->middleware('cheeklang');
    ########################### end maincategorys #############################


    ########################### bigin subcategorys#############################
    Route::get('/subcategorys/{maincategory_id}', 'MainCategoryController@getsubCategoryWithId')->middleware('cheeklang');
    Route::get('/getProuductWithSubCategory/{subcategry_id}/{vendor_id}','ProductController@getProuductWithSubCategory')->middleware('cheeklang');
    Route::get('/getColorWithId/{id}','ProductController@getColorWithId');
    ########################### end subcategorys #############################


    ########################### bigin vendors #############################
    Route::get('/vendors/{id}', 'VendorController@getAllVendorsWithsubCatrgoryID');
    Route::get('/vendor-of-product-of-subctgory/{subCatgory_id}', 'VendorController@getVendorOfProduct')->middleware('cheeklang');
    Route::get('/getProductofVendor/{vendor_id}', 'VendorController@getProductofVendor')->middleware('cheeklang');
    ########################### end vendors #############################

    ########################### bigin Card #############################
    Route::post('/add-to-card', 'CardController@addeToCard');
    Route::get('/get-may-card/{vistorid}', 'CardController@getMayCard');
    Route::get('/get-vistorId','CardController@getVistorId');
    Route::get('/get-count/{vistorid}','CardController@getCount');
    Route::put('/ubdate-card/{id}','CardController@ubdatMyCard');
    Route::put('/delete-card/{id}','CardController@deleteCard');
    
  ########################### end card #############################

});



 
  
