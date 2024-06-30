@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="container mt-4">
        <div class="card mx-auto" style="max-width: 300px;">
            <div class="card-header">
                <h3>Login User</h3>
            </div>
            <div class="card-body">
                <p><a href="/admin/login">Login Administrator</a></p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                               autocomplete="email" autofocus class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                               class="form-control">
                    </div>

                    @if ($errors->has('email'))
                        <div class="alert alert-danger">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <button type="submit" class="btn btn-primary float-end">Login</button>
                </form>
            </div>
        </div>
    </div>
    <br>

@endsection
