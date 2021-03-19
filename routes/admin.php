<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;

Route::get('/', [Admin\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    // JSON DATA
    Route::get('/permissions', [Admin\JsonController::class, 'permissions'])->name('permissions');
    Route::get('/roles', [Admin\JsonController::class, 'roles'])->name('roles');
    Route::get('/users', [Admin\JsonController::class, 'users'])->name('users');
    Route::get('/procurements', [Admin\JsonController::class, 'procurements'])->name('procurements');
    Route::get('/collection_types', [Admin\JsonController::class, 'collection_types'])->name('collection_types');
    Route::get('/categories', [Admin\JsonController::class, 'categories'])->name('categories');
    Route::get('/authors', [Admin\JsonController::class, 'authors'])->name('authors');
    Route::get('/books', [Admin\JsonController::class, 'books'])->name('books');
    Route::get('/currencies', [Admin\JsonController::class, 'currencies'])->name('currencies');
    Route::get('/penalties', [Admin\JsonController::class, 'penalties'])->name('penalties');
});

Route::group(['middleware' => ['auth', 'role:admin|staff_teknis']], function () {
    // PERMISSION
    Route::get('/management/role_management/permissions', [Admin\PermissionController::class, 'index']);
    Route::post('/management/role_management/permissions/store', [Admin\PermissionController::class, 'store']);
    Route::get('/management/role_management/permissions/{id}/detail', [Admin\PermissionController::class, 'show']);
    Route::post('/management/role_management/permissions/{id}/update', [Admin\PermissionController::class, 'update']);
    Route::delete('/management/role_management/permissions/{id}/delete', [Admin\PermissionController::class, 'destroy']);

    //ROLES
    Route::get('/management/role_management/roles', [Admin\RoleController::class, 'index']);
    Route::post('/management/role_management/roles/store', [Admin\RoleController::class, 'store']);
    Route::get('/management/role_management/roles/{id}/detail', [Admin\RoleController::class, 'show']);
    Route::post('/management/role_management/roles/{id}/update', [Admin\RoleController::class, 'update']);
    Route::delete('/management/role_management/roles/{id}/delete', [Admin\RoleController::class, 'delete']);

    // USER
    Route::get('/management/role_management/users', [Admin\UserController::class, 'index']);
    Route::post('/management/role_management/users/store', [Admin\UserController::class, 'store']);
    Route::get('/management/role_management/users/{id}/detail', [Admin\UserController::class, 'show']);
    Route::post('/management/role_management/users/{id}/update', [Admin\UserController::class, 'update']);
    Route::delete('/management/role_management/users/{id}/delete', [Admin\UserController::class, 'delete']);
});

Route::group(['middleware' => ['auth']], function () {
    // JENIS PENGADAAN
    Route::get('/master/procurements', [Admin\ProcurementController::class, 'index']);
    Route::post('/master/procurements/store', [Admin\ProcurementController::class, 'store']);
    Route::get('/master/procurements/{id}/detail', [Admin\ProcurementController::class, 'show']);
    Route::post('/master/procurements/{id}/update', [Admin\ProcurementController::class, 'update']);
    Route::delete('/master/procurements/{id}/delete', [Admin\ProcurementController::class, 'delete']);

    // JENIS KOLEKSI
    Route::get('/master/collection_types', [Admin\CollectionTypeController::class, 'index']);
    Route::post('/master/collection_types/store', [Admin\CollectionTypeController::class, 'store']);
    Route::get('/master/collection_types/{id}/detail', [Admin\CollectionTypeController::class, 'show']);
    Route::post('/master/collection_types/{id}/update', [Admin\CollectionTypeController::class, 'update']);
    Route::delete('/master/collection_types/{id}/delete', [Admin\CollectionTypeController::class, 'delete']);

    // KATEGORI BUKU
    Route::get('/master/categories', [Admin\CategoryController::class, 'index']);
    Route::post('/master/categories/store', [Admin\CategoryController::class, 'store']);
    Route::get('/master/categories/{id}/show', [Admin\CategoryController::class, 'show']);
    Route::get('/master/categories/{id}/edit', [Admin\CategoryController::class, 'edit']);
    Route::post('/master/categories/{id}/update', [Admin\CategoryController::class, 'update']);
    Route::delete('/master/categories/{id}/delete', [Admin\CategoryController::class, 'delete']);

    // AUTHOR
    Route::get('/master/authors', [Admin\AuthorController::class, 'index']);
    Route::post('/master/authors/store', [Admin\AuthorController::class, 'store']);
    Route::get('/master/authors/{id}/show', [Admin\AuthorController::class, 'show']);
    Route::post('/master/authors/{id}/update', [Admin\AuthorController::class, 'update']);
    Route::delete('/master/authors/{id}/delete', [Admin\AuthorController::class, 'delete']);

    // DENDA
    Route::get('/master/penalties', [Admin\PenaltyController::class, 'index']);
    Route::post('/master/penalties/store', [Admin\PenaltyController::class, 'store']);
    Route::get('/master/penalties/{id}/show', [Admin\PenaltyController::class, 'show']);
    Route::get('/master/penalties/{id}/edit', [Admin\PenaltyController::class, 'edit']);
    Route::post('/master/penalties/{id}/update', [Admin\PenaltyController::class, 'update']);
    Route::delete('/master/penalties/{id}/delete', [Admin\PenaltyController::class, 'delete']);

    // MATA UANG
    Route::get('/master/currencies', [Admin\CurrencyController::class, 'index']);
    Route::post('/master/currencies/store', [Admin\CurrencyController::class, 'store']);
    Route::get('/master/currencies/{id}/show', [Admin\CurrencyController::class, 'show']);
    Route::post('/master/currencies/{id}/update', [Admin\CurrencyController::class, 'update']);
    Route::delete('/master/currencies/{id}/delete', [Admin\CurrencyController::class, 'delete']);

    // BOOK
    Route::get('/master/books', [Admin\BookController::class, 'index']);
    Route::post('/master/books/store', [Admin\BookController::class, 'store']);
    Route::get('/master/books/{id}/show', [Admin\BookController::class, 'show']);
    Route::get('/master/books/{id}/detail', [Admin\BookController::class, 'detail']);
    Route::get('/master/books/{id}/edit', [Admin\BookController::class, 'edit']);
    Route::post('/master/books/{id}/update', [Admin\BookController::class, 'update']);
    Route::delete('/master/books/{id}/delete', [Admin\BookController::class, 'delete']);

    Route::get('/master/books/list_category/{id}', [Admin\BookController::class, 'list_category']);
    Route::post('/master/books/{id}/approve', [Admin\BookController::class, 'approve']);
    Route::post('/master/books/{id}/publish', [Admin\BookController::class, 'publish']);
});
