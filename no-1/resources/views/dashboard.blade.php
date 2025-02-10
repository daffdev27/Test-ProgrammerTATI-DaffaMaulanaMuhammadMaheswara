<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container mt-5 text-center">
        <h2 class="fw-bold text-danger"><i class="fas fa-home"></i> Dashboard</h2>
        <p class="text-muted">Anda masuk sebagai <strong><i class="fas fa-user"></i> {{ ucfirst(str_replace('_', ' ', session('role'))) }}</strong></p>

        <div class="row mt-4">
            <div class="col-md-6">
                <a href="{{ route('logharian.index') }}" class="btn btn-danger btn-lg w-100">
                    <i class="fas fa-book"></i> Log Harian
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('verifikasi.index') }}" class="btn btn-warning btn-lg w-100">
                    <i class="fas fa-check-circle"></i> Verifikasi
                </a>
            </div>
        </div>
    </div>
</body>
</html>
