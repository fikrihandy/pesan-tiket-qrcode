@extends('layouts.app')

@section('title', 'User Profile')

@section('content')
    <div class="container mt-4">
        <div class="card mx-auto" style="max-width: 600px;">
            <div class="card-header">
                <h3>User Profile</h3>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Address:</strong> {{ $user->address ?? '-' }}</p>
                <p><strong>Phone Number:</strong> {{ $user->phone_number ?? '-' }}</p>

                @if (Auth::check() && Auth::id() == $user->id)
                    <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-primary">Edit Profile</a>
                    <form action="{{ route('logout') }}" method="POST"
                          style="display: inline-block; margin-left: 10px;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
