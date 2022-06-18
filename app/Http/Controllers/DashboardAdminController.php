<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Book;
use App\Models\Collection;
use App\Models\Circulation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardAdminController extends Controller
{
    public function index() {
        return view('admin.index', [
            'title' => 'Dashboard',
            'books' => Book::count(),
            'members' => Member::count(),
            'circulations' => Circulation::count(),
        ]);
    }

    public function listBuku(Book $book) {
        return view('admin.book.index', [
            'title' => 'Daftar Buku',
            'books' => Book::filter(request(['search']))->paginate(5)->withQueryString()
        ]);
    }

    public function listMember() {
        return view('admin.member.index', [
            'title' => 'Daftar Member',
            'members' => Member::filter(request(['search']))->paginate(5)->withQueryString()
        ]);
    }

    public function listTransaksi() {
        return view('admin.transaction.index', [
            'title' => 'Daftar Transaksi',
            'books' => Book::all(),
            'collections' => Collection::all(),
            'circulations' => Circulation::filter(request(['search']))->paginate(5)->withQueryString()
        ]);
    }
}
