<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            'image' => 'required|image|file'
        ]);

        if($request->file('image')){
            $validateData['image'] = $request->file('image')->store('book-images');
        }

        $validateData['user_id'] = auth()->user()->id;
        Book::create($validateData);
        return redirect('/dashboard/buku')->with('success',"Buku berhasil ditambahkan!");
    }

    public function show(Book $book)
    {
        return view('admin.book.show', [
            'title' => 'Detail Buku ' . $book->judul,
            'books' => $book
        ]);
    }

    public function edit(Book $book)
    {
        return view('admin.book.edit', [
            'title' => 'Edit Buku',
            'books' => $book
        ]);
    }

    public function update(Request $request, Book $book)
    {
        $rules = [
            'judul' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'tahun_terbit' => 'required',
            'kategori' => 'required',
            'image' => 'required|image|file'
        ];

        // jika kode_buku nya berubah
        if ($request->kode_buku != $book->kode_buku) {
            $rules['kode_buku'] = 'required|size:6|unique:books';
        }
        // jika isbn nya berubah
        if ($request->isbn != $book->isbn) {
            $rules['isbn'] = 'required|unique:books';
        }
        
        $validateData = $request->validate($rules);
        
        // jika image nya berubah
        if ($request->file('image')) {
            if ($request->old_image) {
                Storage::delete($request->old_image);
            }
            $validateData['image'] = $request->file('image')->store('book-images');
        }
        
        Book::where('id', $book->id)->update($validateData);

        return redirect('/dashboard/buku')->with('success',"Buku berhasil diperbaharui!");
    }

    public function destroy(Book $book)
    {
        // cek image, jika ada hapus
        if ($book->image) {
            Storage::delete($book->image);
        }
        Book::destroy($book->id);
        return redirect('/dashboard/buku')->with('success', 'Buku berhasil dihapus!');
    }

    public function showCollection(Book $book)
    {
        return view('admin.book.collection.index', [
            'title' => 'Detail Koleksi',
            'books' => $book,
            'collections' => Collection::where('buku_id', 'like', '%' . $book->id . '%')->filter(request(['search']))->paginate(5)->withQueryString()
        ]);
    }






    // public function checkSlug(Request $request)
    // {
    //     $slug = SlugService::createSlug(Post::class, 'slug', $request->judul);
    //     return response()->json(['slug' => $slug]);
    // }
}
