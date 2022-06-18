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
                <h2>Edit Koleksi</h2>
            </div>
            <hr>
            <div class="row gap-3">
                <form action="/dashboard/koleksi/{{ $collections->id }}" method="post">
                    @method('put')
                    @csrf
                    <input type="hidden" id="buku_id" name="buku_id" value="{{ $books->id }}">
                    <div class="form-group row mb-2">
                        <label for="kode_koleksi" class="col-sm-2 col-form-label">Kode Koleksi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('kode_koleksi') is-invalid @enderror" name="kode_koleksi" id="kode_koleksi" placeholder="Masukan kode koleksi..." value="{{ old('kode_koleksi', $collections->kode_koleksi) }}">
                            @error('kode_koleksi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="noreg" class="col-sm-2 col-form-label">No. Registrasi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('noreg') is-invalid @enderror" name="noreg" id="noreg" placeholder="Masukan no registrasi..." value="{{ old('noreg', $collections->noreg) }}">
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
                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror" name="lokasi" id="lokasi" placeholder="Masukan lokasi.." value="{{ old('lokasi', $collections->lokasi) }}">
                            @error('lokasi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-2 col-form-label">Kondisi</label>
                        <div class="col-sm-auto mt-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kondisi" id="inlineRadio1" value="Baik" @if (old('kondisi', $collections->kondisi) == "Baik") checked @endif>
                                <label class="form-check-label" for="inlineRadio1">Baik</label>
                            </div>
        
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kondisi" id="inlineRadio2" value="Rusak" @if (old('kondisi', $collections->kondisi) == "Rusak") checked @endif>
                                <label class="form-check-label" for="inlineRadio2">Rusak</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        {{-- <button class="btn btn-wide btn-danger shadow me-3" type="cancel">Batal</button> --}}
                        <button class="btn btn-wide btn-success shadow" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection