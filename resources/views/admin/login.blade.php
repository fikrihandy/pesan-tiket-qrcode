@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
    <div class="container mt-4">
        <div class="card mx-auto" style="max-width: 300px;">
            <div class="card-header">
                <h3>Admin Login</h3>
            </div>
            <div class="card-body">
                <p><a href="/login">Login User</a></p>
                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input id="username" type="text" name="username" required class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password" name="password" required class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary float-end">Login</button>
                </form>
            </div>
        </div>
    </div>
    <br>
@endsection
