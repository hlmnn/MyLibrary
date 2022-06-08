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
                    <li class="breadcrumb-item active">Buku</li>
                    {{-- <li class="breadcrumb-item active" aria-current="page">Data</li> --}}
                </ol>
            </nav>
        </div>

        {{-- bagian dashboard --}}
        <div class="dashboard">
            <div class="d-flex gap-3">
                <h2>Daftar Buku</h2>
                <a href="/dashboard/buku/tambah"><button type="button" class="btn btn-primary shadow">Tambah Buku</button></a>
            </div>
            <div class="row">
                <div class="col">
                    <form action="/dashboard/buku">
                        <div class="input-group ">
                            <input type="text" class="form-control" placeholder="Cari buku..." name="search">
                            <button class="btn btn-primary" type="submit">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <div class="row gap-3">
                <div class="table-responsive">
                    <table class="table border shadow">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode Buku</th>
                                <th>ISBN</th>
                                <th>Judul Buku</th>
                                <th>Pengarang</th>
                                <th>Penerbit</th>
                                <th>Tahun</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($books as $book)
                            <tr>
                                <td>{{ $loop->iteration + $books->firstItem() - 1 }}</td>
                                <td>{{ $book->kode_buku }}</td>
                                <td>{{ $book->isbn }}</td>
                                <td>{{ $book->judul }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->publisher }}</td>
                                <td>{{ $book->tahun_terbit }}</td>
                                <td>{{ $book->kategori }}</td>
                                <td>{{ $book->stok }}</td>
                                <td>
                                    <div>
                                        <a href="/dashboard/buku/detail"><button type="button" class="btn btn-success">Detail</button></a>
                                        <a href="/dashboard/buku/update/"><button type="button" class="btn btn-warning">Edit</button></a>
                                        <form action="{{ route('books.destroy', ['book' => $book->id]) }}" method="post" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="text-center">Data tidak ditemukan...</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-start">
                    {{-- {{ $members->links() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection