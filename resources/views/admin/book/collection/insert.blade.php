@extends('admin.layouts.main')

@section('main-content')
    <div class="container p-4">
        {{-- bagian breadcrumb --}}
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/dashboard/buku">Buku</a></li>
                    <li class="breadcrumb-item"><a href="/dashboard/buku/detail/{{ $books->id }}">Detail Buku</a></li>
                    <li class="breadcrumb-item"><a href="/dashboard/buku/detail/{{ $books->id }}/koleksi">Koleksi Buku</a></li>
                    <li class="breadcrumb-item active">Tambah Koleksi</li>
                </ol>
            </nav>
        </div>

        {{-- bagian dashboard --}}
        <div class="dashboard">
            <div class="d-flex gap-3">
                <h2>Tambah Koleksi</h2>
            </div>
            <hr>
            <div class="row gap-3">
                <form action="/dashboard/buku/detail/{{ $books->id }}/koleksi/" method="post">
                    @csrf
                    <input type="hidden" id="buku_id" name="buku_id" value="{{ $books->id }}">
                    <div class="form-group row mb-2">
                        <label for="kode_koleksi" class="col-sm-2 col-form-label">Kode Koleksi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('kode_koleksi') is-invalid @enderror" name="kode_koleksi" id="kode_koleksi" placeholder="Masukan kode koleksi..." value="{{ old('kode_koleksi') }}">
                            @error('kode_koleksi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            {{-- <input type="hidden" id="slug" name="slug" required value="{{ old('slug') }}"> --}}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="noreg" class="col-sm-2 col-form-label">No. Registrasi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('noreg') is-invalid @enderror" name="noreg" id="noreg" placeholder="Masukan no registrasi koleksi..." value="{{ old('noreg') }}">
                            @error('noreg')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="lokasi" class="col-sm-2 col-form-label">Lokasi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror" name="lokasi" id="lokasi" placeholder="Masukan lokasi koleksi..." value="{{ old('lokasi') }}">
                            @error('lokasi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <button class="btn btn-wide btn-success shadow" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection