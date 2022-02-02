<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('index');
// });

//Route::resource('/contacts',ContactController::class);
/*
GET/contacts, mapped to the index() method,
GET /contacts/create, mapped to the create() method,
POST /contacts, mapped to the store() method,
GET /contacts/{contact}, mapped to the show() method,
GET /contacts/{contact}/edit, mapped to the edit() method,
PUT/PATCH /contacts/{contact}, mapped to the update() method,
DELETE /contacts/{contact}, mapped to the destroy() method.
*/

Route::get('/',[ContactController::class,'index']);
Route::get('/contacts/create',[ContactController::class,'create'])->name('contacts.create');
Route::post('/contacts/store',[ContactController::class,'store'])->name('contacts.store');
Route::get('/contacts/{contact}/edit',[ContactController::class,'edit'])->name('contacts.edit');
Route::patch('/contacts/{contact}/update',[ContactController::class,'update'])->name('contacts.update');
Route::delete('/contacts/{contact}',[ContactController::class,'destroy'])->name('contacts.destroy');
