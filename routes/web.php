<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\backend\AuthController as BackendAuthController;
use App\Http\Controllers\backend\PostCatalogueController;
use App\Http\Controllers\backend\PostController;
use App\Http\Controllers\ajax\ChangeStatusController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::post('/change-status', [ChangeStatusController::class, 'changeStatus']);
Route::post('/change-statusAll', [ChangeStatusController::class, 'changeStatusAll']);
Route::post('/change-order', [ChangeStatusController::class, 'changeOrder']);

Route::group(['middleware' => ['role:admin,ctv,writer', 'language']], function () {
    Route::get('lang/{lang}', function ($lang) {
        if (in_array($lang, ['en', 'vi'])) {
            session(['lang' => $lang]);
        }
        return redirect()->back();
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::prefix('/user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
        Route::post('/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    });

    Route::prefix('/role')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('role.index');
        Route::get('/create', [RoleController::class, 'create'])->name('role.create');
        Route::post('/store', [RoleController::class, 'store'])->name('role.store');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
        Route::post('/update/{id}', [RoleController::class, 'update'])->name('role.update');
        Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('role.delete');
        Route::post('/destroy/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
    });

    Route::prefix('/post/catalogue')->group(function () {
        Route::get('/', [PostCatalogueController::class, 'index'])->name('post.catalogue.index');
        Route::get('/create', [PostCatalogueController::class, 'create'])->name('post.catalogue.create');
        Route::post('/store', [PostCatalogueController::class, 'store'])->name('post.catalogue.store');
        Route::get('/edit/{id}', [PostCatalogueController::class, 'edit'])->name('post.catalogue.edit');
        Route::post('/update/{id}', [PostCatalogueController::class, 'update'])->name('post.catalogue.update');
        Route::get('/delete/{id}', [PostCatalogueController::class, 'delete'])->name('post.catalogue.delete');
        Route::post('/destroy/{id}', [PostCatalogueController::class, 'destroy'])->name('post.catalogue.destroy');
    });

    Route::prefix('/post')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('post.index');
        Route::get('/create', [PostController::class, 'create'])->name('post.create');
        Route::post('/store', [PostController::class, 'store'])->name('post.store');
        Route::get('/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
        Route::post('/update/{id}', [PostController::class, 'update'])->name('post.update');
        Route::get('/delete/{id}', [PostController::class, 'delete'])->name('post.delete');
        Route::post('/destroy/{id}', [PostController::class, 'destroy'])->name('post.destroy');
    });
});

Route::prefix('/admin')->group(function () {
    Route::get('/', [BackendAuthController::class, 'admin'])->name('admin.auth');
    Route::post('/login', [BackendAuthController::class, 'login'])->name('admin.login');
});
