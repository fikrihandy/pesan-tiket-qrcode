<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pundit FC')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand ms-5" href="{{ url('/') }}">Pundit FC</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @if(Auth::guard('admin')->check())
                    <li class="nav-item">
                        <a class="nav-link me-5" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-5" href="{{ route('admin.games.create') }}">Tambah Pertandingan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-5" href="{{ route('admin.scan') }}">Scan Tiket</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-5" href="#" data-bs-toggle="modal"
                           data-bs-target="#logoutModal">Logout</a>
                    </li>
                @elseif(Auth::check())
                    <li class="nav-item">
                        <a class="nav-link me-5" href="{{ url('/') }}">Pertandingan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-5" href="{{ route('my.tickets') }}">Tiket Saya</a>
                    </li>
                    <li class="nav-item dropdown me-5">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Profil
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.show', ['id' => Auth::user()->id]) }}">Edit
                                    Profil</a></li>
                            <li>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link me-5" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-5" href="{{ route('register') }}">Daftar</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container mt-4">
    @yield('content')
</div>

<!-- Footer -->
<footer class="bg-light text-center text-lg-start mt-auto">
    <div class="container p-4">
        <p class="text-center">Created with ❤️ by <a href="https://www.fikrihandy.my.id">Abdullah Fikri</a>
        </p>
    </div>
</footer>

<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin logout?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="logout-form"
                      action="{{ Auth::guard('admin')->check() ? route('admin.logout') : route('logout') }}"
                      method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
