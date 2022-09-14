<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\CategoryArticleController;

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
    
    
    // Routes only to request data(not views)
    Route::get('/delete/{user}', [UserController::class, 'destroy'])->name('delete.user');
    Route::post('/send/invitation', [RolePermissionController::class, 'send_invitation'])->name('invite.user');
    Route::post('/change/role', [RolePermissionController::class, 'change_role'])->name('change.role');

    // CategoryArticle
    Route::get('/category/list', [CategoryArticleController::class, 'index'])->name('category.list');
    Route::get('/category/create', [CategoryArticleController::class, 'create'])->name('category.create');
    Route::post('/category/save', [CategoryArticleController::class, 'store'])->name('category.save');
    Route::get('/category/{categoryArticle}/edit', [CategoryArticleController::class, 'edit'])->name('category.edit');
    Route::post('/category/{categoryArticle}', [CategoryArticleController::class, 'update'])->name('category.edit');
    Route::post('/category/{categoryArticle}', [CategoryArticleController::class, 'destroy'])->name('category.delete');
});

