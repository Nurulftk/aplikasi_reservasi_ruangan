<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Reservasi Ruangan') - Kampus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 260px;
            --primary: #8b1a3f;
            --primary-dark: #66132f;
            --primary-light: #f7d7e1;
            --bg-body: #fff4f6;
            --bg-sidebar: #3b0f20;
            --sidebar-text: #e7c1cc;
            --sidebar-active: #8b1a3f;
        }
        * { font-family: 'Inter', sans-serif; }
        body { background: var(--bg-body); min-height: 100vh; }

        /* Sidebar */
        .sidebar {
            position: fixed; top: 0; left: 0; bottom: 0;
            width: var(--sidebar-width);
            background: var(--bg-sidebar);
            z-index: 1000;
            transition: transform 0.3s;
            overflow-y: auto;
        }
        .sidebar-brand {
            padding: 1.5rem 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .sidebar-brand h4 {
            color: #fff; font-weight: 700; margin: 0; font-size: 1.1rem;
        }
        .sidebar-brand small { color: var(--sidebar-text); font-size: 0.75rem; }
        .sidebar-nav { padding: 1rem 0; }
        .sidebar-nav .nav-label {
            color: #64748b; font-size: 0.7rem; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.05em;
            padding: 0.75rem 1.25rem 0.5rem;
        }
        .sidebar-nav .nav-link {
            color: var(--sidebar-text); padding: 0.6rem 1.25rem;
            display: flex; align-items: center; gap: 0.75rem;
            font-size: 0.875rem; border-radius: 0;
            transition: all 0.2s; text-decoration: none;
        }
        .sidebar-nav .nav-link:hover {
            color: #fff;
            background: rgba(255,255,255,0.05);
        }
        .sidebar-nav .nav-link.active {
            color: #fff;
            background: var(--sidebar-active);
        }
        .sidebar-nav .nav-link i { font-size: 1.1rem; width: 1.25rem; text-align: center; }

        .btn-primary,
        .bg-primary,
        .text-primary {
            background-color: var(--primary) !important;
            color: #fff !important;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark) !important;
            border-color: var(--primary-dark) !important;
        }

        .bg-primary.bg-opacity-10 {
            background-color: rgba(139, 26, 63, 0.1) !important;
        }

        .badge.bg-primary {
            background-color: var(--primary) !important;
        }

        .text-primary {
            color: var(--primary) !important;
        }

        /* Main content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        /* Top navbar */
        .top-navbar {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.75rem 1.5rem;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 100;
        }
        .top-navbar .user-info {
            display: flex; align-items: center; gap: 0.75rem;
        }
        .top-navbar .user-avatar {
            width: 36px; height: 36px; border-radius: 50%;
            background: var(--primary); color: #fff;
            display: flex; align-items: center; justify-content: center;
            font-weight: 600; font-size: 0.875rem;
        }

        .page-content { padding: 1.5rem; }

        /* Cards */
        .stat-card {
            border: none; border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        .stat-card .stat-icon {
            width: 48px; height: 48px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.25rem;
        }
        .stat-card .stat-value { font-size: 1.75rem; font-weight: 700; }
        .stat-card .stat-label { color: #64748b; font-size: 0.8rem; }

        .table th { font-weight: 600; font-size: 0.8rem; text-transform: uppercase; color: #64748b; }
        .badge { font-weight: 500; }

        .bg-success, .badge.bg-success {
            background-color: #8b1a3f !important;
            color: #fff !important;
        }

        .bg-warning, .badge.bg-warning {
            background-color: #f3a9c2 !important;
            color: #61122f !important;
        }

        .bg-danger, .badge.bg-danger {
            background-color: #c72d4f !important;
            color: #fff !important;
        }

        .bg-info, .badge.bg-info {
            background-color: #eab8ca !important;
            color: #61122f !important;
        }

        .text-dark {
            color: #31121e !important;
        }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>
    {{-- Sidebar --}}
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <h4><i class="bi bi-building"></i> ReservasiKu</h4>
            <small>Sistem Reservasi Ruangan Kampus</small>
        </div>
        <nav class="sidebar-nav">
            @if(auth()->user()->isAdmin())
                <div class="nav-label">Menu Utama</div>
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill"></i> Dashboard
                </a>
                <div class="nav-label">Master Data</div>
                <a href="{{ route('admin.ruangan.index') }}" class="nav-link {{ request()->routeIs('admin.ruangan.*') ? 'active' : '' }}">
                    <i class="bi bi-door-open-fill"></i> Data Ruangan
                </a>
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i> Data Pengguna
                </a>
                <div class="nav-label">Manajemen</div>
                <a href="{{ route('admin.reservasi.index') }}" class="nav-link {{ request()->routeIs('admin.reservasi.*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-check-fill"></i> Data Reservasi
                </a>
                <a href="{{ route('admin.jadwal.index') }}" class="nav-link {{ request()->routeIs('admin.jadwal.*') ? 'active' : '' }}">
                    <i class="bi bi-calendar3"></i> Jadwal Ruangan
                </a>
                <a href="{{ route('admin.laporan.index') }}" class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-bar-graph-fill"></i> Laporan
                </a>
            @else
                <div class="nav-label">Menu Utama</div>
                <a href="{{ route('mahasiswa.dashboard') }}" class="nav-link {{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill"></i> Dashboard
                </a>
                <div class="nav-label">Reservasi</div>
                <a href="{{ route('mahasiswa.reservasi.create') }}" class="nav-link {{ request()->routeIs('mahasiswa.reservasi.create') ? 'active' : '' }}">
                    <i class="bi bi-plus-circle-fill"></i> Buat Reservasi
                </a>
                <a href="{{ route('mahasiswa.reservasi.index') }}" class="nav-link {{ request()->routeIs('mahasiswa.reservasi.index') ? 'active' : '' }}">
                    <i class="bi bi-list-check"></i> Status Reservasi
                </a>
                <a href="{{ route('mahasiswa.jadwal.index') }}" class="nav-link {{ request()->routeIs('mahasiswa.jadwal.*') ? 'active' : '' }}">
                    <i class="bi bi-calendar3"></i> Jadwal Ruangan
                </a>
                <div class="nav-label">Akun</div>
                <a href="{{ route('mahasiswa.profil') }}" class="nav-link {{ request()->routeIs('mahasiswa.profil') ? 'active' : '' }}">
                    <i class="bi bi-person-circle"></i> Profil
                </a>
            @endif
        </nav>
    </aside>

    {{-- Main Content --}}
    <div class="main-content">
        <nav class="top-navbar">
            <button class="btn btn-sm btn-outline-secondary d-md-none" onclick="document.getElementById('sidebar').classList.toggle('show')">
                <i class="bi bi-list"></i>
            </button>
            <div></div>
            <div class="user-info">
                <div>
                    <div style="font-weight:600;font-size:0.875rem;">{{ auth()->user()->nama }}</div>
                    <div style="font-size:0.75rem;color:#64748b;">{{ ucfirst(auth()->user()->role) }}</div>
                </div>
                <div class="user-avatar">{{ strtoupper(substr(auth()->user()->nama, 0, 1)) }}</div>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Logout">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            </div>
        </nav>

        <div class="page-content">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
