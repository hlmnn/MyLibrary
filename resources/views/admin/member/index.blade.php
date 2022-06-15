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
                    <li class="breadcrumb-item active">Member</li>
                    {{-- <li class="breadcrumb-item active" aria-current="page">Data</li> --}}
                </ol>
            </nav>
        </div>

        {{-- bagian dashboard --}}
        <div class="dashboard">
            <div class="d-flex gap-3">
                <h2>Member</h2>
                <a href="/dashboard/member/tambah"><button type="button" class="btn btn-primary shadow">Tambah Member</button></a>
            </div>
            <div class="row">
                <div class="col">
                    <form action="/dashboard/member">
                        <div class="input-group ">
                            <input type="text" class="form-control" placeholder="Cari member..." name="search">
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
                                <th class="col-2">Kode Member</th>
                                <th class="col-3">Nama</th>
                                <th class="col-2">No Telepon</th>
                                <th class="col-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($members as $member)
                            <tr>
                                <td>{{ $loop->iteration + $members->firstItem() - 1 }}</td>
                                <td>{{ $member->kode_member }}</td>
                                <td>{{ $member->nama }}</td>
                                <td>{{ $member->nomor }}</td>
                                <td>
                                    <div>
                                        <a href="/dashboard/member/{{ $member->id }}/edit/"><button type="button" class="btn btn-warning">Edit</button></a>
                                        {{-- <form action="{{ route('members.destroy', ['member' => $member->id]) }}" method="post" class="d-inline"> --}}
                                        <form action="/dashboard/member/{{ $member->id }}" method="post" class="d-inline">
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
                    {{ $members->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection