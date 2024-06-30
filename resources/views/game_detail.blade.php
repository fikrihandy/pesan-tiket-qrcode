@php use Carbon\Carbon; @endphp

@extends('layouts.app')

@section('title', 'Game Detail - Pundit FC')

@section('content')
    <div class="container">
        <h1 class="mb-4">{{ $game->home_team }} vs {{ $game->away_team }}</h1>

        <div class="card mb-4">
            <div class="card-body">
                @if($game->is_home_game)
                    <img src="{{ asset('images/' . rand(1, 3) . '.jpg') }}" class="img-fluid mb-3 mx-auto d-block"
                         style="width: 50%; height: auto; object-fit: cover" alt="Home Stadium">
                @endif

                <p class="card-text"><strong>Waktu:</strong> {{ Carbon::parse($game->match_time)->format('d-m-Y H:i') }}
                    WIB</p>
                <p class="card-text"><strong>Tournament:</strong> {{ $game->tournament_name }}</p>
                <p class="card-text"><strong>Stadium:</strong> {{ $game->stadium_name }}</p>
                <p class="card-text"><strong>Durasi Pembelian:</strong>
                    (s.d) {{ Carbon::parse($game->purchase_duration)->format('d-m-Y H:i') }} WIB</p>
                <p class="card-text"><strong>Status:</strong> {{ ucfirst($game->status) }}</p>
            </div>
        </div>

        <h2 class="mb-4">Tiket Tersedia</h2>

        <form id="checkout_form" method="POST" action="{{ route('checkout') }}">
            @csrf
            <input type="hidden" name="game_id" value="{{ $game->id }}">

            <div class="mb-3">
                <label for="ticket_category" class="form-label">Kategori:</label>
                <select id="ticket_category" name="ticket_category" class="form-select" onchange="updateStockInfo()">
                    @foreach($tickets as $ticket)
                        @php
                            $purchased = $purchasedQuantities[$ticket->category] ?? 0;
                            $remaining = $ticket->quantity - $purchased;
                        @endphp
                        <option value="{{ $ticket->category }}" data-price="{{ $ticket->price }}"
                                data-purchased="{{ $purchased }}"
                                data-total="{{ $ticket->quantity }}" {{ $ticket->category == 'A' ? 'selected' : '' }}>
                            {{ $ticket->category }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <p><strong>Stock:</strong> <span id="stock_quantity">{{ $purchasedQuantities['A'] ?? 0 }}/{{ $tickets->firstWhere('category', 'A')->quantity }}. Tersisa {{ $tickets->firstWhere('category', 'A')->quantity - ($purchasedQuantities['A'] ?? 0) }} tiket</span>
                </p>
            </div>

            <div class="mb-3">
                <label for="purchase_quantity" class="form-label">Jumlah Pembelian:</label>
                <input type="number" id="purchase_quantity" name="purchase_quantity" class="form-control" value="1"
                       min="1" max="2" onchange="updatePrice()">
            </div>

            <div class="mb-3">
                <p><strong>Price:</strong> <span
                        id="ticket_price">Rp{{ number_format($tickets->firstWhere('category', 'A')->price, 0, ',', '.') }}</span>
                </p>
                <div id="purchase_info" class="alert alert-warning" role="alert">
                    Maksimal pembelian 2 tiket per akun!
                </div>
            </div>

            <button type="button" id="buy_button" class="btn btn-primary" onclick="proceedToCheckout()">Beli Ticket
            </button>
        </form>
    </div>
    <br>

    <script>
        function updatePrice() {
            var ticketCategory = document.getElementById('ticket_category');
            var selectedCategory = ticketCategory.options[ticketCategory.selectedIndex];
            var price = parseFloat(selectedCategory.getAttribute('data-price'));
            var quantity = document.getElementById('purchase_quantity').value;
            var totalPrice = price * quantity;
            document.getElementById('ticket_price').innerText = 'Rp' + totalPrice.toLocaleString('id-ID');
        }

        function proceedToCheckout() {
            var form = document.getElementById('checkout_form');
            form.submit();
        }

        function updateStockInfo() {
            var ticketCategory = document.getElementById('ticket_category');
            var selectedCategory = ticketCategory.options[ticketCategory.selectedIndex];
            var purchased = selectedCategory.getAttribute('data-purchased');
            var total = selectedCategory.getAttribute('data-total');
            var remaining = total - purchased;
            document.getElementById('stock_quantity').innerText = purchased + '/' + total + '. Tersisa ' + remaining + ' tiket';

            if (remaining <= 0) {
                document.getElementById('buy_button').style.display = 'none';
                document.getElementById('purchase_info').innerText = 'Telah Habis Terjual!';
            } else {
                document.getElementById('buy_button').style.display = 'inline';
                document.getElementById('purchase_info').innerText = 'Maksimal pembelian 2 tiket per akun!';
            }

            updatePrice();
        }

        function checkPurchaseDuration() {
            var purchaseDuration = new Date("{{ $game->purchase_duration }}");
            var now = new Date();
            if (now > purchaseDuration) {
                document.getElementById('buy_button').disabled = true;
                document.getElementById('purchase_info').innerText = 'Penjualan ditutup karena masa penjualan telah habis.';
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            updateStockInfo();
            checkPurchaseDuration();
        });
    </script>
@endsection
