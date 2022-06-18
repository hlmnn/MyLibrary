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
                    <li class="breadcrumb-item active">Dashboard</li>
                    <li class="breadcrumb-item"><a href="#"></a></li>
                    {{-- <li class="breadcrumb-item active" aria-current="page">Data</li> --}}
                </ol>
            </nav>
        </div>

        {{-- bagian dashboard --}}
        <div class="dashboard">
            <h2>Dashboard</h2>
            <hr>
            <div class="row gap-3">
                <a href="/dashboard/buku" class="col text-decoration-none text-black">
                    <div class="card shadow" style="background-color: rgb(49, 233, 110)">
                        <div class="card-body">
                            <p class="fs-3 fw-semibold">Buku</p>
                            <hr>
                            <p class="fs-5">{{ $books }} Buku Terdaftar</p>
                        </div>
                    </div>
                </a>
                <a href="/dashboard/member" class="col text-decoration-none text-black">
                    <div class="card shadow" style="background-color: rgb(0, 164, 240)">
                        <div class="card-body">
                            <p class="fs-3 fw-semibold">Member</p>
                            <hr>
                            <p class="fs-5">{{ $members }} Member Terdaftar</p>
                        </div>
                    </div>
                </a>
                <a href="/dashboard/transaksi" class="col text-decoration-none text-black">
                    <div class="card shadow" style="background-color: rgb(232, 248, 9)">
                        <div class="card-body">
                            <p class="fs-3 fw-semibold">Transaksi</p>
                            <hr>
                            <p class="fs-5">{{ $circulations }} Transaksi Terdaftar</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection