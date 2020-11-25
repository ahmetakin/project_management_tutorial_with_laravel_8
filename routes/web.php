<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {

    Route::resource('companies', App\Http\Controllers\CompaniesController::class); // biz ekledik return index of controller
    
    Route::resource('projects', App\Http\Controllers\ProjectsController::class); // biz ekledik resource like crud operation pre defined methodlar için create edit etc.
    Route::get('projects/create/{company_id?}',[App\Http\Controllers\ProjectsController::class, 'create']);
    Route::post('projects/adduser',[App\Http\Controllers\ProjectsController::class, 'adduser'])->name('projects.adduser');//adduser methodunu kullanacak controllerdeki

    Route::resource('comments', App\Http\Controllers\CommentsController::class);


    Route::resource('roles', 'RolesController'); // biz ekledik
    Route::resource('tasks', 'TasksController'); // biz ekledik
    Route::resource('users', 'UsersController'); // biz ekledik
    
});

