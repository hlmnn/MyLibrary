@extends('admin.layouts.main')

@section('main-content')
    <div class="container p-4">
        {{-- bagian breadcrumb --}}
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/dashboard/buku">Buku</a></li>
                    <li class="breadcrumb-item active">Tambah Buku</li>
                </ol>
            </nav>
        </div>

        {{-- bagian dashboard --}}
        <div class="dashboard">
            <div class="d-flex gap-3">
                <h2>Tambah Buku</h2>
            </div>
            <hr>
            <div class="row gap-3">
                <form action="/dashboard/buku" method="post">
                    @csrf
                    <div class="form-group row mb-2">
                        <label for="kode_buku" class="col-sm-2 col-form-label">Kode Buku</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('kode_buku') is-invalid @enderror" name="kode_buku" id="kode_buku" placeholder="Masukan kode buku..." value="{{ old('kode_buku') }}">
                            @error('kode_buku')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input type="hidden" id="slug" name="slug" required value="{{ old('slug') }}">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" id="judul" placeholder="Masukan judul..." value="{{ old('judul') }}">
                            @error('judul')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="author" class="col-sm-2 col-form-label">Author</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('author') is-invalid @enderror" name="author" id="author" placeholder="Masukan author..." value="{{ old('author') }}">
                            @error('author')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="publisher" class="col-sm-2 col-form-label">Publisher</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('publisher') is-invalid @enderror" name="publisher" id="publisher" placeholder="Masukan publisher..." value="{{ old('publisher') }}">
                            @error('publisher')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="tahun_terbit" class="col-sm-2 col-form-label">Tahun Terbit</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control @error('tahun_terbit') is-invalid @enderror" name="tahun_terbit" id="tahun_terbit" placeholder="Masukan tahun terbit.." value="{{ old('tahun_terbit') }}">
                            @error('tahun_terbit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="isbn" class="col-sm-2 col-form-label">ISBN</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('isbn') is-invalid @enderror" name="isbn" id="isbn" placeholder="Masukan isbn.." value="{{ old('isbn') }}">
                            @error('isbn')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('kategori') is-invalid @enderror" name="kategori" id="kategori" placeholder="Masukan kategori..." value="{{ old('kategori') }}">
                            @error('kategori')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="stok" class="col-sm-2 col-form-label">Stok Tersedia</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control @error('stok') is-invalid @enderror" name="stok" id="stok" placeholder="Masukan stok.." value="{{ old('stok') }}">
                            @error('stok')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <a href="/dashboard/member"><button class="btn btn-wide btn-danger shadow me-3" type="cancel">Batal</button></a>
                        <button class="btn btn-wide btn-success shadow" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const judul = document.querySelector('#judul');
        const slug = document.querySelector('#slug');

        judul.addEventListener('change', function() {
           fetch('/dashboard/buku/checkSlug?=' + judul.value)
            .then(response => response.json())
            .then(data => slug.value = data.value)
        });
    </script>
@endsection