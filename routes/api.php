<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('users/login', [App\Http\Controllers\UserController::class, 'login']);
Route::post('users/register', 'App\Http\Controllers\UserController@register');

Route::group(['middleware' => 'auth.jwt'], function () {
    /*Login and out routes*/
    Route::get('users/logout', 'App\Http\Controllers\UserController@logout');
    Route::get('users/user', 'App\Http\Controllers\UserController@getAuthUser');

/*Users controller routes*/
    Route::get('/users/allusers', 'App\Http\Controllers\UserController@allUsers');
    Route::get('/users/uniqueuser/{email}', 'App\Http\Controllers\UserController@uniqueUser');
    Route::put('/users/updateuser', 'App\Http\Controllers\UserController@updateUser');
    Route::delete('/users/removeuser', 'App\Http\Controllers\UserController@removeUser');


/*Assetmodel contoller routes*/
    Route::get('/assets/allassets', 'App\Http\Controllers\AssetController@allAssets');
    Route::get('/assets/uniqueasset/{asset_serialNumber}', 'App\Http\Controllers\AssetController@uniqueAsset');
    Route::post('/assets/newasset', 'App\Http\Controllers\AssetController@newAsset');
    Route::put('/assets/updateasset/{asset_serialNumber}', 'App\Http\Controllers\AssetController@updateAsset');
    Route::delete('/assets/removeasset/{asset_serialNumber}', 'App\Http\Controllers\AssetController@removeAsset');

/*Vendormodel contoller routes*/
    Route::get('/vendors/allvendors', 'App\Http\Controllers\VendorController@allVendors');
    Route::get('/vendors/uniquevendor/{vendor_id}', 'App\Http\Controllers\VendorController@uniqueVendor');
    Route::post('/vendors/newvendor', 'App\Http\Controllers\VendorController@newVendors');
    Route::put('/vendors/updatevendor/{vendor_id}', 'App\Http\Controllers\VendorController@updateVendor');
    Route::delete('/vendors/removevendor/{vendor_id}', 'App\Http\Controllers\VendorController@removeVendor');

/*AssetAssignmentmodel contoller routes*/
    Route::get('/assetassignments/allassetassignments', 'App\Http\Controllers\AssetAssignmentController@allAssetsAssignments');
    Route::get('/assetassignments/uniqueassetassignment/{assetassignment_id}', 'App\Http\Controllers\AssetAssignmentController@uniqueAssetsAssignment');
    Route::post('/assetassignments/newassetassignment', 'App\Http\Controllers\AssetAssignmentController@newAssetsAssignment');
    Route::put('/assetassignments/updateassetassignment/{assetassignment_id}', 'App\Http\Controllers\AssetAssignmentController@updateAssetsAssignment');
    Route::delete('/assetassignments/removeassetassignment/{assetassignment_id}', 'App\Http\Controllers\AssetAssignmentController@removeAssetsAssignment');

});