@php use App\Models\Ticket; use Carbon\Carbon; @endphp
@extends('layouts.app')

@section('title', 'Home - Pundit FC')

@section('content')
    <div class="container">
        <h1 class="mb-4">Jadwal Pertandingan</h1>
        <div class="row">
            @foreach($games as $game)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $game->home_team }} vs {{ $game->away_team }}</h5>

                            @if($game->is_home_game)
                                <img src="{{ asset('images/' . rand(1, 3) . '.jpg') }}"
                                     class="img-fluid mb-3" style="width: 100%; height: 200px; object-fit: fill"
                                     alt="Home Stadium">
                            @else
                                <img src="{{ asset('images/away-game.jpg') }}"
                                     class="img-fluid mb-3" style="width: 100%; height: 200px; object-fit: contain"
                                     alt="Away Stadium">
                            @endif

                            <p class="card-text">
                                <strong>Waktu:</strong> {{ Carbon::parse($game->match_time)->format('d-m-Y H:i') }} WIB
                            </p>
                            <p class="card-text"><strong>Turnamen:</strong> {{ $game->tournament_name }}</p>
                            @if($game->is_home_game)
                                @php
                                    $tickets = Ticket::where('game_id', $game->id)->get();
                                    $minPrice = $tickets->min('price');
                                    $maxPrice = $tickets->max('price');
                                @endphp
                                <p class="card-text">Rp{{ number_format($minPrice, 0, ',', '.') }} -
                                    Rp{{ number_format($maxPrice, 0, ',', '.') }}</p>
                                <a href="{{ route('games.show', $game->id) }}" class="btn btn-primary">Buy Ticket</a>
                            @else
                                <p class="card-text">Pertandingan Away!</p>
                                <button type="button" class="btn btn-outline-secondary" disabled>Tidak Tersedia</button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <br>
@endsection
