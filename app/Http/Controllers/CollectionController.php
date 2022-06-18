<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    // public function index()
    // {
    //     return view('admin.book.collection.index', [
    //         'title' => 'Koleksi Buku'
    //     ]);
    // }

    public function create(Book $book)
    {
        return view('admin.book.collection.insert', [
            'title' => 'Tambah Koleksi',
            'books' => $book
        ]);
    }

    public function store(Request $request, Book $book)
    {
        // dd($request);
        $validateData = $request->validate([
            'buku_id' => 'required',
            'kode_koleksi' => 'required|size:6|unique:collections',
            'noreg' => 'required|size:6|unique:collections',
            'lokasi' => 'required'
        ]);
        $validatedData['kondisi'] = "Baik";
        $validatedData['status'] = "Tersedia";

        $validateData['user_id'] = auth()->user()->id;
        Collection::create($validateData);
        return redirect('/dashboard/buku/detail/'.$book->id.'/koleksi')->with('success',"Koleksi berhasil ditambahkan!");
    }

    public function edit(Book $book, Collection $collection)
    {
        return view('admin.book.collection.edit', [
            'title' => 'Edit Buku',
            'books' => $book,
            'collections' => $collection
        ]);
    }

    public function update (Request $request, Collection $collection)
    {
        $rules = [
            'buku_id' => 'required',
            'lokasi' => 'required',
            'kondisi' => 'required'
        ];
        $kode = $request->buku_id;

        // jika kode_buku nya berubah
        if ($request->kode_koleksi != $collection->kode_koleksi) {
            $rules['kode_koleksi'] = 'required|size:6|unique:collections';
        }
        // jika isbn nya berubah
        if ($request->noreg != $collection->noreg) {
            $rules['noreg'] = 'required|size:6|unique:collections';
        }

        $validateData = $request->validate($rules);

        Collection::where('id', $collection->id)->update($validateData);

        return redirect('/dashboard/buku/detail/'.$kode.'/koleksi')->with('success',"Koleksi berhasil diperbaharui!");
    }

    public function destroy(Book $book, Collection $collection)
    {
        Collection::destroy($collection->id);
        return redirect('/dashboard/buku/detail/'.$book->id.'/koleksi')->with('success', 'Koleksi berhasil dihapus!');
    }
}
