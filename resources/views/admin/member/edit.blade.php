@extends('admin.layouts.main')

@section('main-content')
    <div class="container p-4">
        {{-- bagian breadcrumb --}}
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/dashboard/member">Member</a></li>
                    <li class="breadcrumb-item active">Edit Member</li>
                </ol>
            </nav>
        </div>

        {{-- bagian dashboard --}}
        <div class="dashboard">
            <div class="d-flex gap-3">
                <h2>Edit Member</h2>
            </div>
            <hr>
            <div class="row gap-3">
                <form action="/dashboard/member/{{ $members->id }}" method="post">
                    @method('put')
                    @csrf
                    <div class="form-group row mb-2">
                        <label for="kode_member" class="col-sm-2 col-form-label">Kode Member</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('kode_member') is-invalid @enderror" name="kode_member" id="kode_member" placeholder="Masukan kode member..." value="{{ old('kode_member', $members->kode_member) }}">
                            @error('kode_member')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="nama" class="col-sm-2 col-form-label">Nama Member</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Masukan nama..." value="{{ old('nama', $members->nama) }}">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input type="hidden" id="slug" name="slug" required value="{{ old('slug') }}">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="nomor" class="col-sm-2 col-form-label">No. Telepon</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control @error('nomor') is-invalid @enderror" name="nomor" id="nomor" placeholder="Masukan no telepon.." value="{{ old('nomor', $members->nomor) }}">
                            @error('nomor')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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