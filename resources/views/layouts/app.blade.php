<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎬 Filmolog - Film Yönetim Sistemi</title>
    
    <!-- Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body { background-color: #0f172a; color: #f8fafc; font-family: 'Segoe UI', sans-serif; }
        .navbar { background-color: #1e293b !important; border-bottom: 1px solid #334155; }
        .card { background-color: #1e293b; border: 1px solid #334155; color: #f8fafc; transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.4); }
        .form-control, .form-select { background-color: #0f172a; border-color: #334155; color: #f8fafc; }
        .form-control:focus, .form-select:focus { background-color: #0f172a; border-color: #3b82f6; color: #f8fafc; box-shadow: 0 0 0 0.25rem rgba(59,130,246,0.25); }
        .badge-genre { background-color: #3b82f6; }
        .page-link { background-color: #1e293b; border-color: #334155; color: #94a3b8; }
        .page-item.active .page-link { background-color: #3b82f6; border-color: #3b82f6; }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4 text-warning" href="{{ route('movies.index') }}">
                <i class="bi bi-film me-2"></i>Filmolog
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('movies.index') ? 'active' : '' }}" href="{{ route('movies.index') }}">
                            <i class="bi bi-collection-play me-1"></i>Tüm Filmler
                        </a>
                    </li>
                </ul>

                <a href="{{ route('movies.create') }}" class="btn btn-warning fw-semibold">
                    <i class="bi bi-plus-circle me-1"></i>Yeni Film Ekle
                </a>
            </div>
        </div>
    </nav>

    <!-- Bildirim Mesajları (Flash Messages) -->
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show bg-success text-white border-0" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show bg-danger text-white border-0" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>

    <!-- Sayfa İçeriği -->
    <main class="container my-4 flex-grow-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-secondary text-center py-3 border-top border-secondary border-opacity-25 mt-auto">
        <div class="container">
            <small>&copy; {{ date('Y') }} Filmolog - Laravel ile Geliştirilmiştir.</small>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>