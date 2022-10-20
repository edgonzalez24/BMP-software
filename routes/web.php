<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\CategoryArticleController;
use App\Http\Controllers\MeasureUnitsController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PresaleController;
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
    Route::get('/dashboard/articles', [ArticleController::class, 'index'])->name('articles');
    Route::get('/dashboard/stocks/{id}/detail', [StockController::class, 'show'])->name('stocks-details');
    Route::get('/dashboard/stocks', [StockController::class, 'index'])->name('stocks');
    Route::get('/dashboard/clients', [ClientController::class, 'index'])->name('clients');
    Route::get('/dashboard/articles/filter', [ArticleController::class, 'filter'])->name('article.filter');
    Route::get('/dashboard/stocks/filter', [StockController::class, 'filter'])->name('stock.filter');
    Route::get('/dashboard/presales', [PresaleController::class, 'index'])->name('presales');

    Route::get('/dashboard/location', function () { return Inertia::render('Location'); })->name('location');
    
    
    // Routes only to request data(not views)

    // Users
    Route::get('/delete/{user}', [UserController::class, 'destroy'])->name('delete.user');
    
    // Roles and permissions
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
    
    // Articles
    Route::post('/article/save', [ArticleController::class, 'store'])->name('article.save');
    Route::post('/article/change', [ArticleController::class, 'update'])->name('article.change');
    Route::get('/article/delete/{article}', [ArticleController::class, 'destroy'])->name('article.delete');

    // Stocks
    Route::post('/stock/save', [StockController::class, 'store'])->name('stock.save');
    Route::post('/stock/change', [StockController::class, 'update'])->name('stock.change');
    Route::get('/stock/delete/{stock}', [StockController::class, 'destroy'])->name('stock.delete');

    // clients
    Route::post('/client/save', [ClientController::class, 'store'])->name('client.save');
    Route::post('/client/change', [ClientController::class, 'update'])->name('client.change');
    Route::get('/client/delete/{client}', [ClientController::class, 'destroy'])->name('client.delete');

    // presales
    Route::post('/presale/save', [PresaleController::class, 'store'])->name('presale.save');
    Route::post('/presale/change', [PresaleController::class, 'update'])->name('presale.change');
    Route::get('/presale/delete/{presale}', [PresaleController::class, 'destroy'])->name('presale.delete');

    // Map
    Route::post('/map', [PositionController::class, 'store'])->name('map.save');
    
});

