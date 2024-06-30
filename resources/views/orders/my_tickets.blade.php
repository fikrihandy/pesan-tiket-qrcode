@extends('layouts.app')

@section('title', 'Tiket Saya - Pundit FC')

@section('content')
    <div class="container">
        <h1 class="mb-4">Tiket Saya</h1>

        @forelse($orders as $order)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $order->game->home_team }} vs {{ $order->game->away_team }}</h5>
                    <p class="card-text"><strong>Waktu
                            Pertandingan:</strong> {{ Carbon\Carbon::parse($order->game->match_time)->format('d-m-Y H:i') }}
                        WIB</p>
                    <div id="countdown-container-{{ $order->id }}">
                        <p class="card-text"><strong>Hitung Mundur:</strong> <span
                                id="countdown-{{ $order->id }}"></span></p>
                    </div>

                    <p class="card-text"><strong>Status Tiket:</strong>
                        @if($order->status == 'paid')
                            <span class="badge text-bg-danger">Paid</span>
                        @elseif($order->status == 'redeemed')
                            <span class="badge text-bg-success">Redeemed</span>
                        @else
                            <span class="badge text-bg-secondary">{{ ucfirst($order->status) }}</span>
                        @endif
                    </p>

                    <a href="{{ route('ticket.detail', $order->id) }}" class="btn btn-primary">Lihat Tiket</a>
                </div>
            </div>

            <script>
                var countDownDate{{ $order->id }} = new Date("{{ $order->game->match_time }}").getTime();

                var x{{ $order->id }} = setInterval(function () {

                    var now = new Date().getTime();

                    var distance = countDownDate{{ $order->id }} - now;

                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    var countdownText = "";
                    if (days > 0) {
                        countdownText += days + " hari ";
                    }
                    if (hours > 0) {
                        countdownText += hours + " jam ";
                    }
                    if (minutes > 0) {
                        countdownText += minutes + " menit ";
                    }
                    if (seconds > 0) {
                        countdownText += seconds + " detik ";
                    }

                    document.getElementById("countdown-{{ $order->id }}").innerHTML = countdownText;

                    if (distance < 0) {
                        clearInterval(x{{ $order->id }});
                        document.getElementById("countdown-container-{{ $order->id }}").style.display = "none";
                    }
                }, 1000);
            </script>
        @empty
            <h3 class="text-muted">Anda belum memiliki tiket.</h3>
            <br>
        @endforelse
    </div>
@endsection
