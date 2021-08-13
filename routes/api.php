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
    Route::post('/updateProfile','AuthController@updateProfile');
    Route::post('/password/email', 'ForgotPasswordRequestController@sendResetLinkEmail')->middleware('cheeklang');;
    Route::post('/password/reset', 'ResetPasswordRequestController@reset')->middleware('cheeklang');
    

    ########################### end  auth user #############################

});



Route::group([ 'namespace' => 'FrontApi'], function () {
  ########################### bigin maincategorys#############################
    Route::get('/maincategorys', 'MainCategoryController@getAllCategory')->middleware('cheeklang');


 ########################### end maincategorys #############################


########################### bigin subcategorys#############################
Route::get('/subcategorys/{maincategory_id}', 'MainCategoryController@getsubCategoryWithId')->middleware('cheeklang');


########################### end subcategorys #############################


    ########################### bigin vendors #############################
    Route::get('/vendors/{id}','VendorController@getAllVendorsWithsubCatrgoryID');
    
    Route::get('/vendor-of-product-of-subctgory/{subCatgory_id}','VendorController@getVendorOfProduct')->middleware('cheeklang');;

    ########################### end vendors #############################

});





Route::group(
    ['middleware' => 'assign.guard:api'],
    function () {
        ###########################  informtion-profile   #############################
        Route::get(
            '/profile-user',
            function () {
                return Auth::user();
            }
        );
    }
);
   
 
  
   ########################### end maincategorys ############################