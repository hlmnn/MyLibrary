<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
// use \Cviebrock\EloquentSluggable\Services\SlugService;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     return view('admin.book.index', [
    //         'title' => 'Daftar Buku'
    //     ]);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.book.insert', [
            'title' => 'Tambah Buku'
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'kode_buku' => 'required|size:6|unique:books',
            'judul' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'tahun_terbit' => 'required',
            'isbn' => 'required|unique:books',
            'kategori' => 'required',
            'stok' => 'required'
        ]);
        $validateData['user_id'] = auth()->user()->id;
        Book::create($validateData);
        return redirect('/dashboard/buku')->with('success',"Buku berhasil ditambahkan!");
    }

    public function show(Book $book)
    {
        //
    }

    public function edit(Book $book)
    {
        //
    }

    public function update(Request $request, Book $book)
    {
        //
    }

    public function destroy(Book $book)
    {
        Book::destroy($book->id);
        return redirect('/dashboard/buku')->with('success', 'Buku berhasil dihapus!');
    }

    // public function checkSlug(Request $request)
    // {
    //     $slug = SlugService::createSlug(Post::class, 'slug', $request->judul);
    //     return response()->json(['slug' => $slug]);
    // }
}
