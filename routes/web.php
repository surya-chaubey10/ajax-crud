<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxCrudController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [AjaxCrudController::class, 'home']);

Route::post('/save', [AjaxCrudController::class, 'save'])->name('save');

Route::get('/show', [AjaxCrudController::class, 'show'])->name('show');;

Route::get('delete/{id}',[AjaxCrudController::class, 'delete'])->name('delete');

Route::get('edit/{id}',[AjaxCrudController::class, 'edit'])->name('edit');











