@extends('admin.layouts.main')

@section('main-content')
    <div class="container p-4">
        {{-- bagian breadcrumb --}}
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/dashboard/transaksi">Daftar Transaksi</a></li>
                    <li class="breadcrumb-item active">Tambah Transaksi</li>
                </ol>
            </nav>
        </div>

        {{-- bagian dashboard --}}
        <div class="dashboard">
            <div class="d-flex gap-3">
                <h2>Pinjam Buku</h2>
            </div>
            <hr>
            <div class="row gap-3">
                <form action="/dashboard/transaksi" method="post">
                    @csrf
                    <div class="form-group row mb-2">
                        <label for="kode_transaksi" class="col-sm-2 col-form-label">Kode Transaksi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('kode_transaksi') is-invalid @enderror" name="kode_transaksi" id="kode_transaksi" placeholder="Masukan kode transaksi..." value="{{ old('kode_transaksi') }}">
                            @error('kode_transaksi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="kode_koleksi" class="col-sm-2 col-form-label">Kode Koleksi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('kode_koleksi') is-invalid @enderror" name="kode_koleksi" id="kode_koleksi" placeholder="Masukan kode koleksi..." value="{{ old('kode_koleksi') }}">
                            @error('kode_koleksi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="member_id" class="col-sm-2 col-form-label">Nama Peminjam</label>
                        <div class="col-sm-10">
                            <select class="form-select @error('member_id') is-invalid @enderror" id="member_id" name="member_id" required>
                                <option selected disabled>Pilih member</option>
                                @foreach ($members as $member)
                                    <option value="{{ $member->id }}">{{ $member->nama }}</option>
                                @endforeach
                            </select>
                            @error('member_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="tgl_pinjam" class="col-sm-2 col-form-label">Tanggal Pinjam</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control @error('tgl_pinjam') is-invalid @enderror" name="tgl_pinjam" id="tgl_pinjam" placeholder="Masukan tanggal pinjam..." value="{{ old('tgl_pinjam') }}">
                            @error('tgl_pinjam')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="durasi" class="col-sm-2 col-form-label">Lama Pinjam</label>
                        <div class="col-sm-10">
                            <select class="form-select @error('durasi') is-invalid @enderror" id="durasi" name="durasi" required>
                                <option selected disabled>Pilih durasi</option>
                                <option value="3" {{ old('duration') === '3' ? 'selected' : '' }}>3 Hari</option>
                                <option value="7" {{ old('duration') === '3' ? 'selected' : '' }}>7 Hari</option>
                            </select>
                            @error('durasi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <button class="btn btn-wide btn-success shadow" type="submit">Pinjam Buku</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection