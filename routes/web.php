<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\backend\AuthController as BackendAuthController;
use App\Http\Controllers\backend\PostCatalogueController;
use App\Http\Controllers\backend\ProductCatalogueController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\PostController;
use App\Http\Controllers\backend\AttributeController;
use App\Http\Controllers\backend\AttributeValueController;
use App\Http\Controllers\backend\PermissionController;
use App\Http\Controllers\ajax\ChangeStatusController;
use App\Http\Controllers\ajax\ValueAttributeController;

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

Route::post('/getAllAttributeValue', [ValueAttributeController::class, 'getAllAttributeValue']);
Route::post('/getAllAttribute', [ValueAttributeController::class, 'getAllAttribute']);
Route::post('/loadAttribute_value', [ValueAttributeController::class, 'loadAttribute_value']);

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

    Route::prefix('/permission')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('permission.index');
        Route::post('/', [PermissionController::class, 'changePermission'])->name('changePermission.index');
        Route::get('/create', [PermissionController::class, 'create'])->name('permission.create');
        Route::post('/store', [PermissionController::class, 'store'])->name('permission.store');
        Route::get('/edit/{id}', [PermissionController::class, 'edit'])->name('permission.edit');
        Route::post('/update/{id}', [PermissionController::class, 'update'])->name('permission.update');
        Route::get('/delete/{id}', [PermissionController::class, 'delete'])->name('permission.delete');
        Route::post('/destroy/{id}', [PermissionController::class, 'destroy'])->name('permission.destroy');
    });

    Route::prefix('/product/catalogue')->group(function () {
        Route::get('/', [ProductCatalogueController::class, 'index'])->name('product.catalogue.index');
        Route::get('/create', [ProductCatalogueController::class, 'create'])->name('product.catalogue.create');
        Route::post('/store', [ProductCatalogueController::class, 'store'])->name('product.catalogue.store');
        Route::get('/edit/{id}', [ProductCatalogueController::class, 'edit'])->name('product.catalogue.edit');
        Route::post('/update/{id}', [ProductCatalogueController::class, 'update'])->name('product.catalogue.update');
        Route::get('/delete/{id}', [ProductCatalogueController::class, 'delete'])->name('product.catalogue.delete');
        Route::post('/destroy/{id}', [ProductCatalogueController::class, 'destroy'])->name('product.catalogue.destroy');
    });

    Route::prefix('/attribute')->group(function () {
        Route::get('/', [AttributeController::class, 'index'])->name('attribute.index');
        Route::get('/create', [AttributeController::class, 'create'])->name('attribute.create');
        Route::post('/store', [AttributeController::class, 'store'])->name('attribute.store');
        Route::get('/edit/{id}', [AttributeController::class, 'edit'])->name('attribute.edit');
        Route::post('/update/{id}', [AttributeController::class, 'update'])->name('attribute.update');
        Route::get('/delete/{id}', [AttributeController::class, 'delete'])->name('attribute.delete');
        Route::post('/destroy/{id}', [AttributeController::class, 'destroy'])->name('attribute.destroy');
    });

    Route::prefix('/attribute/value')->group(function () {
        Route::get('/', [AttributeValueController::class, 'index'])->name('attribute.value.index');
        Route::get('/create', [AttributeValueController::class, 'create'])->name('attribute.value.create');
        Route::post('/store', [AttributeValueController::class, 'store'])->name('attribute.value.store');
        Route::get('/edit/{id}', [AttributeValueController::class, 'edit'])->name('attribute.value.edit');
        Route::post('/update/{id}', [AttributeValueController::class, 'update'])->name('attribute.value.update');
        Route::get('/delete/{id}', [AttributeValueController::class, 'delete'])->name('attribute.value.delete');
        Route::post('/destroy/{id}', [AttributeValueController::class, 'destroy'])->name('attribute.value.destroy');
    });

    Route::prefix('/product')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('product.index');
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
        Route::post('/destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    });
});

Route::prefix('/admin')->group(function () {
    Route::get('/', [BackendAuthController::class, 'admin'])->name('admin.auth');
    Route::post('/login', [BackendAuthController::class, 'login'])->name('admin.login');
    Route::get('/logout', [BackendAuthController::class, 'logout'])->name('admin.logout');
});
