@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Checkout</h1>
        <div class="card mb-4">
            <div class="card-body">
                <p><strong>Game:</strong> {{ $game->home_team }} vs {{ $game->away_team }}</p>
                <p><strong>Jadwal:</strong> {{ Carbon\Carbon::parse($game->match_time)->format('d-m-Y H:i') }} WIB
                </p>
                <p><strong>Stadium:</strong> {{ $game->stadium_name }}</p>
            </div>
        </div>

        <h2 class="mb-4">Tiket</h2>
        <div class="card mb-4">
            <div class="card-body">
                <p><strong>Kategory:</strong> {{ $ticket->category }}</p>
                <p><strong>Jumlah:</strong> {{ $quantity }}</p>
                <p><strong>Total Harga:</strong> Rp{{ number_format($ticket->price * $quantity, 0, ',', '.') }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('finalize_checkout') }}" onsubmit="return confirmCheckout()">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <input type="hidden" name="game_id" value="{{ $game->id }}">
            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
            <input type="hidden" name="quantity" value="{{ $quantity }}">

            <button type="submit" class="btn btn-primary">Checkout</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <br>

    <script>
        function confirmCheckout() {
            return confirm('Are you sure you want to proceed to checkout?');
        }
    </script>
@endsection
