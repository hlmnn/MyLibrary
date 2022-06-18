@extends('admin.layouts.main')
@section('main-content')
    <div class="container p-4">
        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if (session()->has('failed'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('failed') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        {{-- bagian breadcrumb --}}
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active">Daftar Transaksi</li>
                    {{-- <li class="breadcrumb-item active" aria-current="page">Data</li> --}}
                </ol>
            </nav>
        </div>

        {{-- bagian dashboard --}}
        <div class="dashboard">
            <div class="d-flex gap-3">
                <h2>Daftar Transaksi</h2>
                <a href="/dashboard/transaksi/tambah"><button type="button" class="btn btn-primary shadow">Tambah Transaksi</button></a>
            </div>
            <div class="row">
                <div class="col">
                    <form action="/dashboard/transaksi">
                        <div class="input-group ">
                            <input type="text" class="form-control" placeholder="Cari transaksi..." name="search">
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
                                <th class="col-1">#</th>
                                <th class="col-2">Kode Transaksi</th>
                                <th class="col-3">Judul Buku</th>
                                <th class="col-3">Kode Koleksi</th>
                                <th class="col-3">Nama Peminjam</th>
                                <th class="col-2">Tgl Pinjam</th>
                                <th class="col-2">Durasi</th>
                                <th class="col-2">Tgl Kembali</th>
                                <th class="col-2">Status</th>
                                <th class="col-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($circulations as $circulation)
                            <tr>
                                <td>{{ $loop->iteration + $circulations->firstItem() - 1 }}</td>
                                <td>{{ $circulation->kode_transaksi }}</td>
                                @foreach ($collections as $collection)
                                    @if ($circulation->koleksi_id === $collection->id)
                                        @foreach ($books as $book)
                                            @if ($collection->buku_id === $book->id)
                                                <td>{{ $book->judul }}</td> 
                                            @endif
                                        @endforeach
                                        <td>{{ $collection->kode_koleksi }}</td> 
                                    @endif    
                                @endforeach
                                <td>{{ $circulation->member->nama }}</td>
                                <td>{{ \Carbon\Carbon::parse($circulation->tgl_pinjam)->format('d-m-Y') }}</td>
                                <td>{{ $circulation->durasi }} hari</td>
                                <td>{{ \Carbon\Carbon::parse($circulation->tgl_kembali)->format('d-m-Y') }}</td>
                                <td>{{ $circulation->status }}</td>
                                <td>
                                    <div>
                                        @if ($circulation->status === 'Selesai')
                                            <form action="/dashboard/transaksi/{{ $circulation->id }}" method="post" class="d-inline">
                                            {{-- <form action="#" method="post" class="d-inline"> --}}
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                                            </form>
                                        @else
                                            <form action="/dashboard/transaksi/{{ $circulation->id }}" method="post" class="d-inline">
                                                @method('PUT')
                                                @csrf
                                                <input type="hidden" name="status" id="status" value="Selesai">
                                                <input type="hidden" name="tgl_kembali" id="tgl_kembali" value="2022-01-01">
                                                <button class="btn btn-success">Selesai</button>
                                            </form>
                                            <form action="/dashboard/transaksi/{{ $circulation->id }}" method="post" class="d-inline">
                                            {{-- <form action="#" method="post" class="d-inline"> --}}
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                                            </form>
                                        @endif
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
                    {{ $circulations->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection