<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\CategoryArticleController;
use App\Http\Controllers\MeasureUnitsController;
use App\Http\Controllers\SupplierController;

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
    return redirect('/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
])->group(function () {
    Route::get('/dashboard', function () { return Inertia::render('Dashboard'); })->name('dashboard');
    Route::get('/dashboard/users', [UserController::class, 'index'])->name('users');
    Route::get('/dashboard/profile', function () { return Inertia::render('Profile/Show'); })->name('profile');
    Route::get('/dashboard/categories',  [CategoryArticleController::class, 'index'])->name('categories');
    Route::get('/dashboard/measures', [MeasureUnitsController::class, 'index'])->name('measures');
    Route::get('/dashboard/suppliers', [SupplierController::class, 'index'])->name('suppliers');
    
    
    // Routes only to request data(not views)
    Route::get('/delete/{user}', [UserController::class, 'destroy'])->name('delete.user');
    Route::post('/send/invitation', [RolePermissionController::class, 'send_invitation'])->name('invite.user');
    Route::post('/change/role', [RolePermissionController::class, 'change_role'])->name('change.role');

    // CategoryArticle
    Route::post('/category/save', [CategoryArticleController::class, 'store'])->name('category.save');
    Route::post('/category/change', [CategoryArticleController::class, 'update'])->name('category.change');
    Route::get('/category/delete/{categoryArticle}', [CategoryArticleController::class, 'destroy'])->name('category.delete');
    
    // Measures
    Route::post('/measureUnits/save', [MeasureUnitsController::class, 'store'])->name('measureUnits.save');
    Route::post('/measureUnits/change', [MeasureUnitsController::class, 'update'])->name('measureUnits.change');
    Route::get('/measureUnits/delete/{measureUnits}', [MeasureUnitsController::class, 'destroy'])->name('measureUnits.delete');

    // Supliers
    Route::post('/supplier/save', [SupplierController::class, 'store'])->name('supplier.save');
    Route::post('/supplier/change', [SupplierController::class, 'update'])->name('supplier.change');
    Route::get('/supplier/delete/{supplier}', [SupplierController::class, 'destroy'])->name('supplier.delete');
    
    
});

