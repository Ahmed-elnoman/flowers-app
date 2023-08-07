<?php

use App\Http\Controllers\ColorOfFlowerController;
use App\Http\Controllers\FlowerController;
use App\Http\Controllers\KindOfFlowerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Models\ColorOfFlower;
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


Route::group(['Middleware' => 'auth', 'role:Admin' ] , function(){
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('flower_Kind' , KindOfFlowerController::class);
    Route::get('destroykind/{id}' , [KindOfFlowerController::class , 'destroykind']);

    Route::resource('flowers' , FlowerController::class);
    Route::get('delete_flower/{id}' , [ FlowerController::class , 'deleted']);

    Route::resource('orders' , OrderController::class);

    Route::get('/user' , [UserController::class , 'index'])->name('user.index');

    // ROLES
    Route::get('/roles' , [RolesController::class , 'index'])->name('roles.index');
    Route::post('/roles/store' , [RolesController::class , 'store'])->name('role.store');
    Route::get('/roles/edit/{role}' , [RolesController::class , 'edit'])->name('role.edit');
    Route::post('/roles/update/{role}' , [RolesController::class , 'update'])->name('role.update');
    Route::get('/roles/destroy/{role}' , [RolesController::class , 'destroy'])->name('role.destroy');
    Route::post('/roles/givePermission/{role}' , [RolesController::class , 'givePermission'])->name('role.permission.giv');
    Route::get('/roles/{role}/permission/{permission}' , [RolesController::class , 'revoke'])->name('role.permission.revoke');

    // PERMISSIONS
    Route::get('/permissions' , [PermissionsController::class , 'index'])->name('permission.index');
    Route::post('/permission/store' , [PermissionsController::class , 'store'])->name('permission.store');
    Route::get('/permission/edit/{permission}' , [PermissionsController::class , 'edit'])->name('permission.edit');
    Route::post('/permission/update/{permission}' , [PermissionsController::class , 'update'])->name('permission.update');
    Route::get('/permission/destroy/{permission}' , [PermissionsController::class , 'destroy'])->name('permission.destroy');
    Route::post('/permission/assign/{permission}' , [PermissionsController::class , 'assign'])->name('permission.assign');
    Route::get('/permission/{permission}/roles/{role}' , [PermissionsController::class , 'removeRole'])->name('permission.role.removeRole');


    // USERS -> ADMINS
    Route::get('/supplier' , [SupplierController::class , 'index'])->name('supplier.index');
    Route::post('/supplier/store' , [SupplierController::class , 'store'])->name('supplier.store');
    // Route::get('/supplier' , [SupplierController::class , 'index'])->name('supplier.index');

});
require __DIR__.'/auth.php';
