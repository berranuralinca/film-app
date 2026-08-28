<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎬 Filmolog - Sinematik Film Yönetim Sistemi</title>
    
    <!-- Google Fonts: Plus Jakarta Sans & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --font-main: 'Plus Jakarta Sans', sans-serif;
            --font-heading: 'Outfit', sans-serif;
            --bg-dark: #09060d;
            --bg-glass: rgba(20, 12, 26, 0.65);
            --bg-glass-card: rgba(24, 14, 32, 0.62);
            --bg-glass-hover: rgba(38, 20, 48, 0.78);
            --glass-border: rgba(255, 255, 255, 0.08);
            --glass-border-hover: rgba(244, 63, 94, 0.35);
            --glass-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.5);
            --accent-rose: #f43f5e;
            --accent-rose-glow: rgba(244, 63, 94, 0.45);
            --accent-pink: #ec4899;
            --accent-pink-glow: rgba(236, 72, 153, 0.45);
            --accent-crimson: #e11d48;
            --accent-crimson-glow: rgba(225, 29, 72, 0.45);
            --accent-light-rose: #fb7185;
            --accent-magenta: #d946ef;
        }

        * {
            box-sizing: border-box;
        }

        body {
            background-color: var(--bg-dark);
            color: #f1f5f9;
            font-family: var(--font-main);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6, .navbar-brand, .font-heading {
            font-family: var(--font-heading);
            letter-spacing: -0.02em;
        }

        /* Ambient Glowing Background Orbs (Pink & Red Cinema Glow) */
        .ambient-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .glow-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.6;
            animation: orbFloat 18s ease-in-out infinite alternate;
        }

        .glow-orb-1 {
            width: 550px;
            height: 550px;
            background: radial-gradient(circle, rgba(244, 63, 94, 0.28) 0%, rgba(244, 63, 94, 0) 70%);
            top: -100px;
            left: -100px;
            animation-duration: 22s;
        }

        .glow-orb-2 {
            width: 650px;
            height: 650px;
            background: radial-gradient(circle, rgba(236, 72, 153, 0.24) 0%, rgba(236, 72, 153, 0) 70%);
            bottom: 5%;
            right: -150px;
            animation-duration: 26s;
            animation-delay: -5s;
        }

        .glow-orb-3 {
            width: 480px;
            height: 480px;
            background: radial-gradient(circle, rgba(225, 29, 72, 0.22) 0%, rgba(225, 29, 72, 0) 70%);
            top: 40%;
            left: 30%;
            animation-duration: 30s;
            animation-delay: -10s;
        }

        @keyframes orbFloat {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(60px, 40px) scale(1.1); }
            100% { transform: translate(-40px, 70px) scale(0.95); }
        }

        /* Glassmorphism Classes */
        .glass-panel {
            background: var(--bg-glass-card);
            backdrop-filter: blur(20px) saturate(190%);
            -webkit-backdrop-filter: blur(20px) saturate(190%);
            border: 1px solid var(--glass-border);
            box-shadow: var(--glass-shadow);
            border-radius: 18px;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .glass-panel:hover {
            border-color: var(--glass-border-hover);
        }

        .glass-card {
            background: var(--bg-glass-card);
            backdrop-filter: blur(18px) saturate(190%);
            -webkit-backdrop-filter: blur(18px) saturate(190%);
            border: 1px solid var(--glass-border);
            box-shadow: var(--glass-shadow);
            border-radius: 18px;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
        }

        .glass-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(251, 113, 133, 0.35), transparent);
            pointer-events: none;
        }

        .glass-card:hover {
            transform: translateY(-6px) scale(1.01);
            background: var(--bg-glass-hover);
            border-color: rgba(244, 63, 94, 0.4);
            box-shadow: 0 16px 40px -10px rgba(0, 0, 0, 0.65), 0 0 30px rgba(244, 63, 94, 0.25);
        }

        /* Navbar */
        .glass-nav {
            background: rgba(10, 6, 14, 0.8) !important;
            backdrop-filter: blur(24px) saturate(200%);
            -webkit-backdrop-filter: blur(24px) saturate(200%);
            border-bottom: 1px solid rgba(244, 63, 94, 0.15);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .brand-logo-glow {
            text-shadow: 0 0 20px rgba(244, 63, 94, 0.7), 0 0 40px rgba(236, 72, 153, 0.35);
            transition: all 0.3s ease;
        }
        .brand-logo-glow:hover {
            text-shadow: 0 0 25px rgba(244, 63, 94, 0.95), 0 0 50px rgba(236, 72, 153, 0.6);
            transform: scale(1.02);
        }

        .nav-link {
            color: #94a3b8 !important;
            font-weight: 500;
            padding: 8px 16px !important;
            border-radius: 12px;
            transition: all 0.25s ease;
        }
        .nav-link:hover, .nav-link.active {
            color: #fda4af !important;
            background: rgba(244, 63, 94, 0.12);
            border: 1px solid rgba(244, 63, 94, 0.25);
            box-shadow: 0 0 15px rgba(244, 63, 94, 0.15);
        }

        /* Glass Form Controls */
        .form-control, .form-select {
            background-color: rgba(14, 8, 20, 0.7) !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
            color: #f8fafc !important;
            border-radius: 12px;
            padding: 10px 14px;
            backdrop-filter: blur(10px);
            transition: all 0.25s ease;
        }

        .form-control:focus, .form-select:focus {
            background-color: rgba(22, 12, 30, 0.9) !important;
            border-color: var(--accent-rose) !important;
            box-shadow: 0 0 0 0.25rem rgba(244, 63, 94, 0.25), 0 0 20px rgba(244, 63, 94, 0.2) !important;
            color: #ffffff !important;
        }

        .form-control::placeholder {
            color: #64748b;
        }

        .form-select option {
            background-color: #120a1a;
            color: #f1f5f9;
        }

        .input-group-text {
            background-color: rgba(14, 8, 20, 0.8) !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
            color: #fda4af !important;
            border-radius: 12px 0 0 12px;
        }

        /* Buttons with Neon Pink & Red Sheen */
        .btn-glow-rose, .btn-glow-warning {
            background: linear-gradient(135deg, #f43f5e 0%, #e11d48 50%, #be123c 100%) !important;
            border: none !important;
            color: #ffffff !important;
            font-weight: 700;
            border-radius: 12px;
            box-shadow: 0 4px 22px rgba(244, 63, 94, 0.45);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-glow-rose:hover, .btn-glow-warning:hover {
            color: #ffffff !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 30px rgba(244, 63, 94, 0.7);
            background: linear-gradient(135deg, #fb7185 0%, #f43f5e 100%) !important;
        }

        .btn-glow-primary {
            background: linear-gradient(135deg, #ec4899 0%, #f43f5e 100%);
            border: none;
            color: #fff;
            font-weight: 600;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(236, 72, 153, 0.4);
            transition: all 0.3s ease;
        }

        .btn-glow-primary:hover {
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 28px rgba(236, 72, 153, 0.65);
            background: linear-gradient(135deg, #f472b6 0%, #ec4899 100%);
        }

        .btn-glass {
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: #e2e8f0;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.25s ease;
        }

        .btn-glass:hover {
            background: rgba(244, 63, 94, 0.15);
            border-color: rgba(244, 63, 94, 0.35);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(244, 63, 94, 0.2);
        }

        .btn-glass-danger {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #f87171;
            border-radius: 12px;
            transition: all 0.25s ease;
        }

        .btn-glass-danger:hover {
            background: rgba(239, 68, 68, 0.3);
            border-color: #ef4444;
            color: #ffffff;
            box-shadow: 0 0 15px rgba(239, 68, 68, 0.4);
            transform: translateY(-2px);
        }

        /* Dynamic Genre Badges */
        .badge-genre-tag {
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.03em;
            backdrop-filter: blur(8px);
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: all 0.25s ease;
        }

        .genre-sci-fi, .genre-bilim-kurgu {
            background: rgba(244, 63, 94, 0.18);
            color: #fda4af;
            border: 1px solid rgba(251, 113, 133, 0.4);
            box-shadow: 0 0 12px rgba(244, 63, 94, 0.25);
        }

        .genre-aksiyon, .genre-action {
            background: rgba(225, 29, 72, 0.2);
            color: #f87171;
            border: 1px solid rgba(244, 63, 94, 0.4);
            box-shadow: 0 0 12px rgba(225, 29, 72, 0.25);
        }

        .genre-dram, .genre-drama {
            background: rgba(236, 72, 153, 0.18);
            color: #f472b6;
            border: 1px solid rgba(244, 114, 182, 0.4);
            box-shadow: 0 0 12px rgba(236, 72, 153, 0.25);
        }

        .genre-komedi, .genre-comedy {
            background: rgba(244, 63, 94, 0.16);
            color: #fb7185;
            border: 1px solid rgba(251, 113, 133, 0.35);
            box-shadow: 0 0 12px rgba(244, 63, 94, 0.2);
        }

        .genre-korku, .genre-horror, .genre-gerilim, .genre-thriller {
            background: rgba(190, 18, 60, 0.25);
            color: #fecdd3;
            border: 1px solid rgba(225, 29, 72, 0.45);
            box-shadow: 0 0 12px rgba(225, 29, 72, 0.3);
        }

        .genre-animasyon, .genre-animation {
            background: rgba(217, 70, 239, 0.18);
            color: #e879f9;
            border: 1px solid rgba(217, 70, 239, 0.35);
            box-shadow: 0 0 12px rgba(217, 70, 239, 0.25);
        }

        .genre-macera, .genre-adventure {
            background: rgba(251, 113, 133, 0.18);
            color: #fecdd3;
            border: 1px solid rgba(251, 113, 133, 0.4);
            box-shadow: 0 0 12px rgba(251, 113, 133, 0.25);
        }

        .genre-default {
            background: rgba(244, 63, 94, 0.18);
            color: #fda4af;
            border: 1px solid rgba(251, 113, 133, 0.35);
            box-shadow: 0 0 12px rgba(244, 63, 94, 0.2);
        }

        /* Rating Stars and Score Badge (Pink & Rose Glow) */
        .rating-badge {
            background: rgba(20, 10, 24, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(244, 63, 94, 0.4);
            color: #fb7185;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(244, 63, 94, 0.3);
        }

        /* Glass Pagination */
        .pagination {
            gap: 6px;
        }

        .page-link {
            background: rgba(24, 14, 32, 0.65) !important;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            color: #94a3b8 !important;
            border-radius: 10px !important;
            padding: 8px 16px;
            font-weight: 600;
            transition: all 0.25s ease;
        }

        .page-link:hover {
            background: rgba(244, 63, 94, 0.15) !important;
            color: #ffffff !important;
            border-color: rgba(244, 63, 94, 0.35) !important;
            transform: translateY(-2px);
        }

        .page-item.active .page-link {
            background: linear-gradient(135deg, #f43f5e 0%, #e11d48 100%) !important;
            border-color: #f43f5e !important;
            color: #ffffff !important;
            box-shadow: 0 0 20px rgba(244, 63, 94, 0.5);
        }

        .page-item.disabled .page-link {
            background: rgba(14, 8, 20, 0.3) !important;
            color: #475569 !important;
            border-color: rgba(255, 255, 255, 0.04) !important;
        }

        /* Glass Alerts / Flash Messages */
        .glass-alert {
            background: rgba(24, 12, 30, 0.85) !important;
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-radius: 14px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: #f8fafc;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        }

        .glass-alert-success {
            border-left: 4px solid #ec4899 !important;
            box-shadow: 0 8px 30px rgba(236, 72, 153, 0.2);
        }

        .glass-alert-danger {
            border-left: 4px solid #f43f5e !important;
            box-shadow: 0 8px 30px rgba(244, 63, 94, 0.2);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }
        ::-webkit-scrollbar-track {
            background: #09060d;
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(244, 63, 94, 0.25);
            border-radius: 5px;
            border: 2px solid #09060d;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(244, 63, 94, 0.6);
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Ambient Glowing Orbs in Background (Pink & Red Theme) -->
    <div class="ambient-bg">
        <div class="glow-orb glow-orb-1"></div>
        <div class="glow-orb glow-orb-2"></div>
        <div class="glow-orb glow-orb-3"></div>
    </div>

    <!-- Floating Glass Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark glass-nav sticky-top py-3">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3 text-danger brand-logo-glow d-flex align-items-center" href="{{ route('movies.index') }}">
                <span class="me-2 d-inline-flex align-items-center justify-content-center bg-danger bg-opacity-10 text-danger rounded-circle p-2 border border-danger border-opacity-30 shadow-sm" style="box-shadow: 0 0 15px rgba(244, 63, 94, 0.3) !important;">
                    <i class="bi bi-film fs-4" style="color: #fb7185;"></i>
                </span>
                <span style="background: linear-gradient(135deg, #fda4af 0%, #fb7185 30%, #f43f5e 65%, #e11d48 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Filmolog</span>
            </a>
            
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4 gap-2">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('movies.index') ? 'active' : '' }}" href="{{ route('movies.index') }}">
                            <i class="bi bi-collection-play me-1"></i>Keşfet & Tüm Filmler
                        </a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('movies.create') }}" class="btn btn-glow-rose px-3 py-2 d-flex align-items-center gap-2">
                        <i class="bi bi-plus-circle-fill fs-5"></i>
                        <span>Yeni Film Ekle</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Bildirim Mesajları (Flash Messages) -->
    <div class="container mt-4 position-relative" style="z-index: 10;">
        @if (session('success'))
            <div class="alert glass-alert glass-alert-success alert-dismissible fade show d-flex align-items-center p-3" role="alert">
                <i class="bi bi-check-circle-fill text-success fs-4 me-3"></i>
                <div class="flex-grow-1">
                    <strong class="text-white">Başarılı!</strong>
                    <div class="text-light opacity-90">{{ session('success') }}</div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert glass-alert glass-alert-danger alert-dismissible fade show d-flex align-items-center p-3" role="alert">
                <i class="bi bi-exclamation-triangle-fill text-danger fs-4 me-3"></i>
                <div class="flex-grow-1">
                    <strong class="text-white">Hata!</strong>
                    <div class="text-light opacity-90">{{ session('error') }}</div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>

    <!-- Sayfa İçeriği -->
    <main class="container my-4 flex-grow-1 position-relative" style="z-index: 5;">
        @yield('content')
    </main>

    <!-- Glass Footer -->
    <footer class="glass-panel text-secondary text-center py-4 mt-auto border-start-0 border-end-0 border-bottom-0 rounded-0" style="background: rgba(6, 10, 18, 0.85); z-index: 10;">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
            <div class="d-flex align-items-center gap-2 text-light opacity-75">
                <i class="bi bi-camera-reels text-warning"></i>
                <span class="fw-semibold">Filmolog Cinema Universe</span>
            </div>
            <small class="text-muted">&copy; {{ date('Y') }} Filmolog - Laravel & Glassmorphism UI ile hazırlanmıştır.</small>
            <div class="d-flex gap-3 text-secondary">
                <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-2 py-1">v2.0 Glass Edition</span>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>