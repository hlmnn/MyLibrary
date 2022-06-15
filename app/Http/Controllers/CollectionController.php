<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     return view('admin.book.collection.index', [
    //         'title' => 'Koleksi Buku'
    //     ]);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Book $book)
    {
        return view('admin.book.collection.insert', [
            'title' => 'Tambah Koleksi',
            'books' => $book
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function show(Collection $collection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book, Collection $collection)
    {
        return view('admin.book.collection.edit', [
            'title' => 'Edit Buku',
            'books' => $book,
            'collections' => $collection
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collection $collection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book, Collection $collection)
    {
        Collection::destroy($collection->id);
        return redirect('/dashboard/buku/detail/'.$book->id.'/koleksi')->with('success', 'Koleksi berhasil dihapus!');
    }
}
