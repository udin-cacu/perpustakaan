<?php

use Illuminate\Support\Facades\Route;

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
    return view('splash.index');
});

Route::get('/contact', function () {
    return view('member.contact');
});

Route::get('/about', function () {
    return view('member.about');
});

/*Route::get('/petugas', function () {
    return view('member.petugas');
});*/

Route::get('/petugas', [App\Http\Controllers\UsersController::class, 'petugas'])->name('petugas');

Route::get('/books', [App\Http\Controllers\BooksController::class, 'index2'])->name('books.index2');

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
    Route::get('/profile', [App\Http\Controllers\UsersController::class, 'dataprofile'])->name('profile');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    /*ROUTE ADMIN & PETUGAS*/
    Route::middleware(['auth', 'role:1,2'])->group(function () {

        Route::get('/book', [App\Http\Controllers\BooksController::class, 'index'])->name('book.index');
        Route::get('/book/data', [App\Http\Controllers\BooksController::class, 'data'])->name('book.data');
        Route::post('/book/store', [App\Http\Controllers\BooksController::class, 'store'])->name('book.store');
        Route::post('/book/delete', [App\Http\Controllers\BooksController::class, 'delete'])->name('book.delete');
        Route::post('/book/edit', [App\Http\Controllers\BooksController::class, 'edit'])->name('book.edit');
        Route::post('/book/update', [App\Http\Controllers\BooksController::class, 'update'])->name('book.update');
        Route::post('/book/upload', [App\Http\Controllers\BooksController::class, 'upload'])->name('book.upload');
        Route::post('/book/upload2', [App\Http\Controllers\BooksController::class, 'upload2'])->name('book.upload2');
        Route::post('/book/view', [App\Http\Controllers\BooksController::class, 'view'])->name('book.view');

        Route::get('/member', [App\Http\Controllers\UsersController::class, 'index'])->name('member.index');
        Route::get('/member/data', [App\Http\Controllers\UsersController::class, 'data'])->name('member.data');
        Route::post('/member/store', [App\Http\Controllers\UsersController::class, 'store'])->name('member.store');
        Route::post('/member/delete', [App\Http\Controllers\UsersController::class, 'delete'])->name('member.delete');
        Route::post('/member/edit', [App\Http\Controllers\UsersController::class, 'edit'])->name('member.edit');
        Route::post('/member/update', [App\Http\Controllers\UsersController::class, 'update'])->name('member.update');
        Route::post('/member/upload', [App\Http\Controllers\UsersController::class, 'upload'])->name('member.upload');
        Route::post('/member/view', [App\Http\Controllers\UsersController::class, 'view'])->name('member.view');

        Route::get('/karyawan', [App\Http\Controllers\UsersController::class, 'index2'])->name('karyawan.index2');
        Route::get('/karyawan/data2', [App\Http\Controllers\UsersController::class, 'data2'])->name('karyawan.data2');
        Route::post('/karyawan/store2', [App\Http\Controllers\UsersController::class, 'store2'])->name('karyawan.store2');
        Route::post('/karyawan/delete2', [App\Http\Controllers\UsersController::class, 'delete2'])->name('karyawan.delete2');
        Route::post('/karyawan/edit2', [App\Http\Controllers\UsersController::class, 'edit2'])->name('karyawan.edit2');
        Route::post('/karyawan/update2', [App\Http\Controllers\UsersController::class, 'update2'])->name('karyawan.update2');
        Route::post('/karyawan/upload2', [App\Http\Controllers\UsersController::class, 'upload2'])->name('karyawan.upload2');
        Route::post('/karyawan/view2', [App\Http\Controllers\UsersController::class, 'view2'])->name('karyawan.view2');

        Route::get('/pinjam', [App\Http\Controllers\PinjamController::class, 'index2'])->name('pinjam.index2');
        Route::get('/pinjam/data2', [App\Http\Controllers\PinjamController::class, 'data2'])->name('pinjam.data2');
        Route::post('/pinjam/edit', [App\Http\Controllers\PinjamController::class, 'edit'])->name('pinjam.edit');
        Route::post('/pinjam/update', [App\Http\Controllers\PinjamController::class, 'update'])->name('pinjam.update');
        Route::post('/pinjam/delete', [App\Http\Controllers\PinjamController::class, 'delete'])->name('pinjam.delete');

        Route::get('/deadline', [App\Http\Controllers\PinjamController::class, 'index3'])->name('deadline.index3');
        Route::get('/deadline/data3', [App\Http\Controllers\PinjamController::class, 'data3'])->name('deadline.data3');

    });



    Route::middleware(['auth', 'role:3'])->group(function () {

        Route::get('/konfirmasipinjam', [App\Http\Controllers\PinjamController::class, 'index'])->name('konfirmasipinjam.index');
        Route::get('/konfirmasipinjam/data', [App\Http\Controllers\PinjamController::class, 'data'])->name('konfirmasipinjam.data');
        Route::post('/pinjam/store', [App\Http\Controllers\PinjamController::class, 'store'])->name('pinjam.store');
        Route::post('/profile/upload', [App\Http\Controllers\UsersController::class, 'upload'])->name('profile.upload');
        Route::post('/profile/storeprofile', [App\Http\Controllers\UsersController::class, 'storeprofile'])->name('profile.storeprofile');

    });

});
