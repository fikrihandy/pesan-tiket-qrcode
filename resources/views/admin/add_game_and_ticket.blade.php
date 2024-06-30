@extends('layouts.app')

@section('title', 'Tambah Pertandingan & Tiket')

@section('content')
    <div class="container">
        <h1 class="mb-4">Tambah Pertandingan & Tiket</h1>
        <form action="{{ route('admin.games.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="home_team" class="form-label">Home Team:</label>
                <input type="text" class="form-control" id="home_team" name="home_team" value="Pundit FC" required>
            </div>
            <div class="mb-3">
                <label for="away_team" class="form-label">Away Team:</label>
                <input type="text" class="form-control" id="away_team" name="away_team" required>
            </div>
            <div class="mb-3">
                <label for="match_time" class="form-label">Waktu Pertandingan:</label>
                <input type="datetime-local" class="form-control" id="match_time" name="match_time" required>
            </div>
            <div class="mb-3">
                <label for="is_home_game" class="form-label">Sebagai Tuan Rumah?</label>
                <select id="is_home_game" name="is_home_game" class="form-select" required
                        onchange="toggleTicketFields()">
                    <option value="1">Ya</option>
                    <option value="0">Tidak</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="tournament_name" class="form-label">Nama Kompetisi:</label>
                <input type="text" class="form-control" id="tournament_name" name="tournament_name" required>
            </div>
            <div class="mb-3">
                <label for="purchase_duration" class="form-label">Pembelian Sampai:</label>
                <input type="datetime-local" class="form-control" id="purchase_duration" name="purchase_duration"
                       required>
            </div>
            <div class="mb-3">
                <label for="stadium_name" class="form-label">Nama Stadion:</label>
                <input type="text" class="form-control" id="stadium_name" name="stadium_name" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status:</label>
                <select id="status" name="status" class="form-select" required>
                    <option value="scheduled">Scheduled</option>
                    <option value="postponed">Postponed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
            <div id="ticket-fields" style="display: none;">
                <h2 class="mb-4">Atur Ticket</h2>
                <div class="mb-3">
                    <label for="vip_ticket_quantity" class="form-label">Jumlah Tiket VIP:</label>
                    <input type="number" class="form-control" id="vip_ticket_quantity" name="vip_ticket_quantity">
                </div>
                <div class="mb-3">
                    <label for="vip_ticket_price" class="form-label">Harga Tiket VIP:</label>
                    <input type="number" class="form-control" id="vip_ticket_price" name="vip_ticket_price">
                </div>
                <div class="mb-3">
                    <label for="a_ticket_quantity" class="form-label">Jumlah Tiket Cat A:</label>
                    <input type="number" class="form-control" id="a_ticket_quantity" name="a_ticket_quantity">
                </div>
                <div class="mb-3">
                    <label for="a_ticket_price" class="form-label">Harga Tiket Cat A:</label>
                    <input type="number" class="form-control" id="a_ticket_price" name="a_ticket_price">
                </div>
                <div class="mb-3">
                    <label for="b_ticket_quantity" class="form-label">Jumlah Tiket Cat B:</label>
                    <input type="number" class="form-control" id="b_ticket_quantity" name="b_ticket_quantity">
                </div>
                <div class="mb-3">
                    <label for="b_ticket_price" class="form-label">Harga Tiket Cat B:</label>
                    <input type="number" class="form-control" id="b_ticket_price" name="b_ticket_price">
                </div>
                <div class="mb-3">
                    <label for="guest_supporter_ticket_quantity" class="form-label">Jumlah Tiket Guest
                        Supporter:</label>
                    <input type="number" class="form-control" id="guest_supporter_ticket_quantity"
                           name="guest_supporter_ticket_quantity">
                </div>
                <div class="mb-3">
                    <label for="guest_supporter_ticket_price" class="form-label">Harga Tiket Guest Supporter:</label>
                    <input type="number" class="form-control" id="guest_supporter_ticket_price"
                           name="guest_supporter_ticket_price">
                </div>
            </div>
            <button type="submit" id="submit_button" class="btn btn-primary">Tambah Pertandingan & Tiket</button>
        </form>
    </div>

    <script>
        function toggleTicketFields() {
            const isHomeGame = document.getElementById('is_home_game').value;
            const ticketFields = document.getElementById('ticket-fields');
            const submitButton = document.getElementById('submit_button');
            if (isHomeGame === '1') {
                ticketFields.style.display = 'block';
                submitButton.innerText = 'Tambah Pertandingan & Tiket';
            } else {
                ticketFields.style.display = 'none';
                submitButton.innerText = 'Tambah Pertandingan';
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            toggleTicketFields();
        });
    </script>
@endsection
