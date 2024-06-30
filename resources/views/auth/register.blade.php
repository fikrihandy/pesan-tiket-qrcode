@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="container mt-4">
        <div class="card mx-auto" style="max-width: 300px;">
            <div class="card-header">
                <h3>Register</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name"
                               autofocus class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                               autocomplete="email" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                               class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                               autocomplete="new-password" class="form-control">
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <button type="submit" class="btn btn-primary float-end">Register & Login</button>
                </form>
            </div>
        </div>
    </div>
    <br>
@endsection
