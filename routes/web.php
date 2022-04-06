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

/* Language */
Route::get('lang/{locale}',function ($locale){
    App::setLocale($locale);
    session()->put('locale', $locale);
    return back();
});
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::group(['prefix'=>'xadmin','middleware' => ['web', 'auth']],function (){
    /* Users Management */
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
    Route::resource('/users',\App\Http\Controllers\Admin\UserController::class);
    Route::get('/users/dt/list',[\App\Http\Controllers\Admin\UserController::class,'DTList'])->name('users.dtlist');
    Route::post('/user/update',[\App\Http\Controllers\Admin\UserController::class,'updatePassword'])->name('user.update');

    /* Types Management */
    Route::resource('/types',\App\Http\Controllers\Admin\TypeController::class);
    Route::get('/types/dt/list',[\App\Http\Controllers\Admin\TypeController::class,'DTList'])->name('types.dtlist');

    /* Vendors Management */
    Route::resource('/vendors',\App\Http\Controllers\Admin\VendorController::class);
    Route::get('/vendors/dt/list',[\App\Http\Controllers\Admin\VendorController::class,'DTList'])->name('vendors.dtlist');

    /* Clients Management */
    Route::resource('/clients',\App\Http\Controllers\Admin\ClientController::class);
    Route::get('/clients/dt/list',[\App\Http\Controllers\Admin\ClientController::class,'DTList'])->name('clients.dtlist');

    /* Projects Management */
    Route::resource('/projects',\App\Http\Controllers\Admin\ProjectController::class);
    Route::get('/projects/dt/list',[\App\Http\Controllers\Admin\ProjectController::class,'DTList'])->name('projects.dtlist');

    Route::get('projects/{id}/equipments',[\App\Http\Controllers\Admin\ProjectEquipmentsController::class,'index'])->name('project.equipments');
    Route::post('projects/{id}/equipments',[\App\Http\Controllers\Admin\ProjectEquipmentsController::class,'save'])->name('project.equipments.save');
    Route::delete('projects/equipments/delete/{id}',[\App\Http\Controllers\Admin\ProjectEquipmentsController::class,'delete'])->name('project.equipments.delete');


    Route::get('projects/{id}/payments',[\App\Http\Controllers\Admin\ProjectPaymentsController::class,'index'])->name('project.payments');
    Route::post('projects/{id}/payments',[\App\Http\Controllers\Admin\ProjectPaymentsController::class,'save'])->name('project.payments.save');
    Route::delete('projects/payments/delete/{id}',[\App\Http\Controllers\Admin\ProjectPaymentsController::class,'delete'])->name('project.payment.delete');

    /* Equipments Management */
    Route::resource('/equipments',\App\Http\Controllers\Admin\EquipmentController::class);
    Route::get('/equipments/dt/list',[\App\Http\Controllers\Admin\EquipmentController::class,'DTList'])->name('equipments.dtlist');
    Route::get('/equipments/{id}/qrcode',[\App\Http\Controllers\Admin\EquipmentController::class,'view_qrcode'])->name('equipments.qrcode');


    /* Deposits Management */
    Route::resource('/deposits',\App\Http\Controllers\Admin\DepositController::class);
    Route::get('/deposits/dt/list',[\App\Http\Controllers\Admin\DepositController::class,'DTList'])->name('deposits.dtlist');

    /* Withdrawals Management */
    Route::resource('/withdrawals',\App\Http\Controllers\Admin\WithdrawalController::class);
    Route::get('/withdrawals/dt/list',[\App\Http\Controllers\Admin\WithdrawalController::class,'DTList'])->name('withdrawals.dtlist');


});
