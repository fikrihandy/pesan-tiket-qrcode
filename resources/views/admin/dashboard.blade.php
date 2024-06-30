@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Selamat datang di Dashboard Admin</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Tambahkan Pertandingan Baru & Tiket</h5>
                        <p class="card-text">Klik di bawah untuk menambahkan pertandingan baru dan mengelola tiket.</p>
                        <a href="{{ route('admin.games.create') }}" class="btn btn-primary">Tambah Pertandingan &
                            Tiket</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Pindai Kode QR</h5>
                        <p class="card-text">Gunakan fitur ini untuk memindai kode QR untuk validasi tiket.</p>
                        <a href="{{ route('admin.scan') }}" class="btn btn-primary">Pindai Kode QR</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Logout</h5>
                        <p class="card-text">Keluar dari akun Administrator.</p>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
