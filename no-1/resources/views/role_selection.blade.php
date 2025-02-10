<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Role</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body { background-color: #f8d7da; }
        .card { border-radius: 10px; }
        .btn-primary { background-color: #dc3545; border-color: #dc3545; }
        .btn-primary:hover { background-color: #b02a37; }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg p-4">
            <h2 class="text-center text-danger"><i class="fas fa-user"></i> Pilih Role Anda</h2>
            <form action="{{ route('set.role') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="role" class="form-label fw-bold"><i class="fas fa-user-tag"></i> Role:</label>
                    <select name="role" class="form-control" required>
                        <option value="kepala_dinas">📌 Kepala Dinas</option>
                        <option value="kepala_bidang_1">📌 Kepala Bidang 1</option>
                        <option value="kepala_bidang_2">📌 Kepala Bidang 2</option>
                        <option value="staff_1">📌 Staff 1</option>
                        <option value="staff_2">📌 Staff 2</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-sign-in-alt"></i> Masuk
                </button>
            </form>
        </div>
    </div>
</body>
</html>
