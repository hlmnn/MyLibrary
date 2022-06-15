<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Book;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardAdminController extends Controller
{
    public function index() {
        return view('admin.index', [
            'title' => 'Dashboard',
            'books' => Book::count(),
            'members' => Member::count(),
        ]);
    }

    public function listBuku(Book $book) {
        return view('admin.book.index', [
            'title' => 'Daftar Buku',
            'books' => Book::filter(request(['search']))->paginate(5)->withQueryString()
        ]);
    }

    public function listMember() {
        // $members = Member::orderBy('kode_member');

        return view('admin.member.index', [
            'title' => 'Daftar Member',
            'members' => Member::filter(request(['search']))->paginate(5)->withQueryString()
        ]);
    }
}
