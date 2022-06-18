<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\CirculationController;
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

# === route untuk halaman awal ===
Route::get('/', [PageController::class, 'index']);
// Route::get('/buku', [PageController::class, 'showBook']);


// route untuk halaman login
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);


// route untuk halaman admin dashboard
Route::get('/dashboard', [DashboardAdminController::class, 'index'])->middleware('auth');
Route::get('/dashboard/buku', [DashboardAdminController::class, 'listBuku'])->middleware('auth');
Route::get('/dashboard/member', [DashboardAdminController::class, 'listMember'])->middleware('auth');
Route::get('/dashboard/transaksi', [DashboardAdminController::class, 'listTransaksi'])->middleware('auth');


# === route untuk halaman member ===
// route tambah member
Route::get('/dashboard/member/tambah', [MemberController::class, 'create'])->middleware('auth');
Route::post('/dashboard/member', [MemberController::class,'store'])->middleware('auth');
// route update member
Route::get('/dashboard/member/{member}/edit', [MemberController::class, 'edit'])->middleware('auth');
Route::put('/dashboard/member/{member}', [MemberController::class, 'update'])->middleware('auth');
// route delete member
Route::delete('/dashboard/member/{member}', [MemberController::class, 'destroy'])->middleware('auth');


# === route untuk halaman buku ===
// route menampilkan detail buku
Route::get('/dashboard/buku/detail/{book}', [BookController::class, 'show'])->middleware('auth');
// route tambah buku
Route::get('/dashboard/buku/tambah', [BookController::class, 'create'])->middleware('auth');
Route::post('/dashboard/buku', [BookController::class,'store'])->middleware('auth');
// route update buku
Route::get('/dashboard/buku/{book}/edit', [BookController::class, 'edit'])->middleware('auth');
Route::put('/dashboard/buku/{book}', [BookController::class, 'update'])->middleware('auth');
// route delete buku
Route::delete('/dashboard/buku/{book}', [BookController::class, 'destroy'])->middleware('auth');


# === route untuk halaman koleksi ===
// route menampilkan koleksi buku
Route::get('/dashboard/buku/detail/{book}/koleksi', [BookController::class, 'showCollection'])->middleware('auth');
// route tambah koleksi
Route::get('/dashboard/buku/detail/{book}/koleksi/tambah/', [CollectionController::class, 'create'])->middleware('auth');
Route::post('/dashboard/buku/detail/{book}/koleksi', [CollectionController::class,'store'])->middleware('auth');
// route update koleksi
Route::get('/dashboard/buku/detail/{book}/koleksi/{collection}/edit', [CollectionController::class, 'edit'])->middleware('auth');
Route::put('/dashboard/koleksi/{collection}', [CollectionController::class, 'update'])->middleware('auth');
// route delete koleksi
Route::delete('/dashboard/buku/detail/{book}/koleksi/{collection}', [CollectionController::class, 'destroy'])->middleware('auth');


# === route untuk halaman transaksi ===
// route tambah transaksi
Route::get('/dashboard/transaksi/tambah', [CirculationController::class, 'create'])->middleware('auth');
Route::post('/dashboard/transaksi/', [CirculationController::class,'store'])->middleware('auth');
// route update transaksi
Route::put('/dashboard/transaksi/{circulation}', [CirculationController::class, 'update'])->middleware('auth');
// route delete member
Route::delete('/dashboard/transaksi/{circulation}', [CirculationController::class, 'destroy'])->middleware('auth');