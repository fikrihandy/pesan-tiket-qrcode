@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="card mx-auto">
        <div class="card-header">
            <h3>Edit Profile</h3>
        </div>
        <div class="card-body">
            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('profile.update', $user->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name" value="{{ $user->name }}" required class="form-control">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" value="{{ $user->email }}" required class="form-control">
                </div>

                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" id="phone_number" name="phone_number" value="{{ $user->phone_number }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" id="address" name="address" value="{{ $user->address }}" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('profile.show', $user->id) }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
