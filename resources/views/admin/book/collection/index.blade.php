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
                    <li class="breadcrumb-item"><a href="/dashboard/buku/detail/{{ $books->id }}">Detail Buku</a></li>
                    <li class="breadcrumb-item active">Koleksi Buku</li>
                </ol>
            </nav>
        </div>

        {{-- bagian dashboard --}}
        <div class="dashboard">
            <div class="d-flex gap-3">
                <h2>Koleksi Buku</h2>
                <a href="/dashboard/buku/detail/{{ $books->id }}/koleksi/tambah"><button type="button" class="btn btn-primary shadow">Tambah Koleksi</button></a>
            </div>
            <div class="row">
                <div class="col">
                    <form action="/dashboard/buku/detail/{{ $books->id }}/koleksi/">
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
                    <p class="fs-5"><strong>Judul Buku:</strong> {{ $books->judul }}</p>
                    <table class="table border shadow">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode Koleksi</th>
                                <th>No. Registrasi</th>
                                <th>Lokasi</th>
                                <th>Kondisi</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($collections as $collection)
                                @if ($collection->buku_id == $books->id)
                                <tr>
                                    {{-- <td>{{ $loop->iteration + $collections->firstItem() - 1 }}</td> --}}
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $collection->kode_koleksi }}</td>
                                    <td>{{ $collection->noreg }}</td>
                                    <td>{{ $collection->lokasi }}</td>
                                    <td>{{ $collection->kondisi }}</td>
                                    <td>{{ $collection->status }}</td>
                                    <td>
                                        <div>
                                            <a href="/dashboard/buku/detail/{{ $collection->id }}"><button type="button" class="btn btn-success">Pinjam</button></a>
                                            <a href="/dashboard/buku/detail/{{ $books->id }}/koleksi/{{ $collection->id }}/edit/"><button type="button" class="btn btn-warning">Edit</button></a>
                                            <form action="/dashboard/buku/detail/{{ $books->id }}/koleksi/{{ $collection->id }}" method="post" class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                            @empty
                            <tr>
                                <td colspan="10" class="text-center">Data tidak ditemukan...</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-start">
                    {{ $collections->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection