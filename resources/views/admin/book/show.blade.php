@extends('admin.layouts.main')
@section('main-content')
    <div class="container p-4">
        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        {{-- bagian breadcrumb --}}
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/dashboard/buku">Buku</a></li>
                    <li class="breadcrumb-item active">Detail Buku</li>
                    {{-- <li class="breadcrumb-item active" aria-current="page">Data</li> --}}
                </ol>
            </nav>
        </div>

        {{-- bagian dashboard --}}
        <div class="dashboard">
            <div class="d-flex gap-3">
                <h2>Detail Buku</h2>
            </div>
            <hr>
            <div class="row gap-3">
                <div class="col-3">
                    <img src="{{  asset('storage/'.$books->image) }}" alt="{{ $books->judul }}" height="400">
                </div>
                <div class="col">
                    <p><strong>Judul: </strong>{{ $books->judul }}</p>
                    <p><strong>Author: </strong>{{ $books->author }}</p>
                    <p><strong>Publisher: </strong>{{ $books->publisher }}</p>
                    <p><strong>Tahun Terbit: </strong>{{ $books->tahun_terbit }}</p>
                    <p><strong>ISBN: </strong>{{ $books->isbn }}</p>
                    <p><strong>Kategori: </strong>{{ $books->kategori }}</p>
                </div>
                <div class="col text-end">
                    <a href="/dashboard/buku/detail/{{ $books->id }}/koleksi"><button type="button" class="btn btn-info">Koleksi</button></a>
                    <a href="/dashboard/buku/{{ $books->id }}/edit/"><button type="button" class="btn btn-warning">Edit</button></a>
                    <form action="/dashboard/buku/{{ $books->id }}" method="post" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection