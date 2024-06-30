@extends('layouts.app')

@section('title', 'Ticket Detail - Pundit FC')

@section('content')
    <div class="container">
        <h1 class="mb-4">Detail Tiket</h1>

        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{ $order->game->home_team }} vs {{ $order->game->away_team }}</h3>
                <p class="card-text"><strong>Waktu
                        Pertandingan:</strong> {{ Carbon\Carbon::parse($order->game->match_time)->format('d-m-Y H:i') }} WIB
                </p>
                <p class="card-text"><strong>Stadium:</strong> {{ $order->game->stadium_name }}</p>
                <p class="card-text"><strong>Kategori Tiket:</strong> {{ $order->ticket->category }}</p>
                <p class="card-text"><strong>Jumlah:</strong> {{ $order->quantity }}</p>
                <p class="card-text"><strong>Status:</strong>
                    @if($order->status == 'paid')
                        <span class="badge text-bg-danger">Paid</span>
                    @elseif($order->status == 'redeemed')
                        <span class="badge text-bg-success">Redeemed</span>
                    @else
                        <span class="badge text-bg-secondary">{{ ucfirst($order->status) }}</span>
                    @endif
                </p>
                <div class="text-center mt-4">
                    <p class="card-text"><strong>QR Code:</strong></p>
                    <p class="card-text">Tunjukkan Kepada Penjaga Gate Stadion</p>
                    {!! $qrCode !!}
                </div>
            </div>
        </div>

        <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">Kembali</a>
    </div>
@endsection
