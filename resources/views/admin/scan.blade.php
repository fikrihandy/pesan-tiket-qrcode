@extends('layouts.app')

@section('title', 'Scan QR Code - Pundit FC')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Scan QR Code</h1>

        <div class="card">
            <div class="card-body">
                <div id="reader" style="width:60%; margin: auto;"></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            console.log(`Code matched = ${decodedText}`, decodedResult);
            fetch('{{ route('admin.update_order_status') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({qr_code: decodedText})
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Scan berhasil, silahkan masuk!');
                    } else {
                        alert('Gagal melakukan validasi.');
                    }
                });
        }

        function onScanFailure(error) {
            console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {fps: 10, qrbox: 500});
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
@endsection
