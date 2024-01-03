<?php

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminPermissionController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\AdminStatisticalController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


// ===================== ADMIN ========================= //

Route::middleware('admin', 'auth')->group(function () { 

    // Route dashboard
    Route::get('admin/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Route order
    Route::get('admin/order', [AdminOrderController::class, 'index'])->name('admin.order.show');
    Route::get('admin/order/{id}', [AdminOrderController::class, 'edit'])->name('admin.order.edit');
    Route::post('admin/order/{id}', [AdminOrderController::class, 'update'])->name('admin.order.update');
    // Route::get('admin/order/delete/{id}', [AdminOrderController::class, 'delete'])->name('admin.order.delete');

    // Route user
    Route::get('admin/user', [AdminUserController::class, 'index'])->name('admin.user.show')->can('user.view');
    Route::get('admin/user/add', [AdminUserController::class, 'add'])->name('admin.user.add')->can('user.add');
    Route::post('admin/user/store', [AdminUserController::class, 'store'])->name('admin.user.store')->can('user.add');
    Route::get('admin/user/delete/{id}', [AdminUserController::class, 'delete'])->name('admin.user.delete')->can('user.delete');
    Route::post('admin/user/action', [AdminUserController::class, 'action'])->name('admin.user.action')->can('user.delete');
    Route::get('admin/user/edit/{id}', [AdminUserController::class, 'edit'])->name('admin.user.edit')->can('user.edit');
    Route::post('admin/user/update/{id}', [AdminUserController::class, 'update'])->name('admin.user.update')->can('user.edit');
    Route::get('admin/user/restore/{id}', [AdminUserController::class, 'restore'])->name('admin.user.restore');
    Route::get('admin/user/forceDelete/{id}', [AdminUserController::class, 'forceDelete'])->name('admin.user.forceDelete');


    // Route permission
    Route::get('admin/permission', [AdminPermissionController::class, 'add'])->name('admin.permission')->can('permission.view');
    Route::get('admin/permission/add', [AdminPermissionController::class, 'add'])->name('admin.permission.add')->can('permission.add');    
    Route::post('admin/permission/store', [AdminPermissionController::class, 'store'])->name('admin.permission.store')->can('permission.add');
    Route::get('admin/permission/edit/{id}', [AdminPermissionController::class, 'edit'])->name('admin.permission.edit')->can('permission.edit');
    Route::post('admin/permission/update/{id}', [AdminPermissionController::class, 'update'])->name('admin.permission.update')->can('permission.edit');
    Route::get('admin/permission/delete/{id}', [AdminPermissionController::class, 'delete'])->name('admin.permission.delete')->can('permission.delete');

    // Route role
    Route::get('admin/role', [AdminRoleController::class, 'show'])->name('admin.role.show')->can('role.view');
    Route::get('admin/role/add', [AdminRoleController::class, 'add'])->name('admin.role.add')->can('role.add');
    Route::post('admin/role/store', [AdminRoleController::class, 'store'])->name('admin.role.store')->can('role.add');
    Route::get('admin/role/edit/{role}', [AdminRoleController::class, 'edit'])->name('admin.role.edit')->can('role.edit');
    Route::post('admin/role/update/{role}', [AdminRoleController::class, 'update'])->name('admin.role.update')->can('role.edit');
    Route::get('admin/role/delete/{role}', [AdminRoleController::class, 'delete'])->name('admin.role.delete')->can('role.delete');

    // Route category
    Route::get('admin/category', [AdminCategoryController::class, 'index'])->name('admin.category.show');
    Route::get('admin/category/add', [AdminCategoryController::class, 'add'])->name('admin.category.add');
    Route::post('admin/category/store', [AdminCategoryController::class, 'store'])->name('admin.category.store');
    Route::get('admin/category/edit/{id}', [AdminCategoryController::class,'edit'])->name('admin.category.edit');
    Route::post('admin/category/update/{id}', [AdminCategoryController::class, 'update'])->name('admin.category.update');
    Route::get('admin/category/delete/{id}', [AdminCategoryController::class, 'delete'])->name('admin.category.delete');
    Route::post('admin/category/action/', [AdminCategoryController::class, 'action'])->name('admin.category.action');
    Route::get('admin/category/restore/{id}', [AdminCategoryController::class, 'restore'])->name('admin.category.restore');
    Route::get('admin/category/forceDelete/{id}', [AdminCategoryController::class, 'forceDelete'])->name('admin.category.forceDelete');

    // Route product
    Route::get('admin/product', [AdminProductController::class, 'index'])->name('admin.product.show');
    Route::get('admin/product/add', [AdminProductController::class, 'add'])->name('admin.product.add');
    Route::post('admin/product/store', [AdminProductController::class, 'store'])->name('admin.product.store');
    Route::get('admin/product/edit/{id}', [AdminProductController::class, 'edit'])->name('admin.product.edit');
    Route::post('admin/product/update/{id}', [AdminProductController::class, 'update'])->name('admin.product.update');
    Route::get('admin/product/delete/{id}', [AdminProductController::class, 'delete'])->name('admin.product.delete');
    Route::get('admim/product/restore/{id}', [AdminProductController::class, 'restore'])->name('admin.product.restore');
    Route::get('admin/product/forceDelete/{id}', [AdminProductController::class, 'forceDelete'])->name('admin.product.forceDelete');
    
    // Route statistical
    Route::get('admin/statistical', [AdminStatisticalController::class, 'index'])->name('admin.statistical.show');


    // Tích hợp trình quản lý file tiny
    Route::group(['prefix' => 'laravel-filemanager'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});



// =================================== GUEST =================================== //

// ============ home ================ //
Route::get('/', [HomeController::class, 'index'])->name('guest.home');
Route::get('/{id}', [HomeController::class, 'detailProduct'])->name('guest.detailProduct')-> where('id', '[0-9]+');
Route::get('/order', [HomeController::class, 'order'])->name('guest.viewOrder')->middleware('auth');

// ============ cart ================ //
Route::get('cart/show', [CartController::class, 'show'])->name('cart.show');
Route::get('cart/add/{id}', [CartController::class, 'addCart'])->name('cart.add')->where('id', '[0-9]+');;
Route::post('cart/update', [CartController::class, 'update'])->name('cart.update');
Route::get('cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
Route::get('cart/delete', [CartController::class, 'deleteAll'])->name('cart.deleteAll');
Route::get('cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('cart/checkout', [CartController::class, 'handlerCheckout'])->name('cart.handlerCheckout');

