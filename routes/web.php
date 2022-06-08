<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BookController;
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

Route::get('/', [PageController::class, 'index']);


// route untuk halaman login
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);


// route untuk halaman admin dashboard
Route::get('/dashboard', [DashboardAdminController::class, 'index'])->middleware('auth');
Route::get('/dashboard/buku', [DashboardAdminController::class, 'listBuku'])->middleware('auth');
Route::get('/dashboard/member', [DashboardAdminController::class, 'listMember'])->middleware('auth');
Route::get('/dashboard/peminjaman', [DashboardAdminController::class, 'listPinjam'])->middleware('auth');


# === route untuk halaman member ===
Route::get('/dashboard/member/detail', [MemberController::class, 'show']);
// route tambah member
Route::get('/dashboard/member/tambah', [MemberController::class, 'create']);
Route::post('/dashboard/member', [MemberController::class,'store']);
// route update member
Route::get('/dashboard/member/update', [MemberController::class, 'edit']);
Route::put('/dashboard/member/{member}', [MemberController::class, 'update']);
// route delete member
// Route::delete('/dashboard/member/{member}', [MemberController::class, 'destroy']);
Route::delete('/dashboard/member/{member}', [MemberController::class, 'destroy'])->name('members.destroy');


# === route untuk halaman buku ===
Route::get('/dashboard/buku/detail', [BookController::class, 'show']);
// route tambah buku
Route::get('/dashboard/buku/tambah', [BookController::class, 'create']);
Route::post('/dashboard/buku', [BookController::class,'store']);
// route delete buku
Route::delete('/dashboard/buku/{book}', [BookController::class, 'destroy'])->name('books.destroy');


// Route::get('/member/tambah-member', function () {
//     return view('admin.member.insert', [
//         'title' => 'Tambah Member'
//     ]);
// });