<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login') - ReservasiKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #4d1124 0%, #f7d7e1 100%);
            display: flex; align-items: center; justify-content: center;
        }
        .auth-card {
            background: #fff7f8;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.12);
            overflow: hidden;
            max-width: 440px;
            width: 100%;
        }
        .auth-header {
            background: linear-gradient(135deg, #8b1a3f, #e8b7c9);
            padding: 2rem;
            text-align: center; color: #fff;
        }
        .auth-header h3 { font-weight: 700; margin-bottom: 0.25rem; }
        .auth-header p { opacity: 0.95; font-size: 0.875rem; margin: 0; }
        .auth-body { padding: 2rem; }
        .form-control:focus { border-color: #8b1a3f; box-shadow: 0 0 0 0.2rem rgba(139,26,63,0.15); }
        .btn-primary {
            background: #8b1a3f; border: none; padding: 0.6rem;
            font-weight: 600; border-radius: 8px;
        }
        .btn-primary:hover { background: #66132f; }
        .input-group-text { background: #fff0f3; border-right: 0; }
        .form-control { border-left: 0; }
    </style>
</head>
<body>
    <div class="auth-card">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
