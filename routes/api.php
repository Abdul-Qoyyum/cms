<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ContactController;
use Illuminate\Http\Request;
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

Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

//Authenticated Routes
Route::middleware('auth:sanctum')->group(function (){
  Route::get('/me', [AuthController::class,'user']);
  Route::get('/categories',[CategoryController::class,'getAllCategories']);

  Route::controller(ContactController::class)->group(function (){
      Route::get('contacts','getContacts');
      Route::get('contact/{contact_id}','getContact');
      Route::put('contact/{contact_id}','updateContact');
      Route::post('contact','createContact');
      Route::post('contact/upload-profile-image','createContactImage');
      Route::delete('contact/delete-contact-image','deleteContactImage');
  });


});
