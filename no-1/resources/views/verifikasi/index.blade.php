<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Log</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f8d7da;
        }
        .card-header {
            background-color: #dc3545 !important;
            color: white;
            font-weight: bold;
        }
        .table thead {
            background-color: #dc3545;
            color: white;
        }
        .btn-success, .btn-danger {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center fw-bold text-danger"><i class="fas fa-check-circle"></i> Verifikasi Log Harian</h2>
        <p class="text-center text-muted">Anda masuk sebagai <strong>{{ ucfirst(str_replace('_', ' ', session('role'))) }}</strong></p>

        <div class="table-responsive mt-4">
            <table class="table table-hover table-bordered align-middle">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Pegawai</th>
                        <th>Bidang</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Dibuat Pada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $index => $log)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td><i class="fas fa-user"></i> {{ $log->pegawai->nama }}</td>
                            <td><i class="fas fa-briefcase"></i> {{ ucfirst(str_replace('_', ' ', $log->pegawai->role)) }}</td>
                            <td>{{ $log->deskripsi }}</td>
                            <td class="text-center">
                                @if($log->status == 'Pending')
                                    <span class="badge bg-warning"><i class="fas fa-clock"></i> {{ $log->status }}</span>
                                @elseif($log->status == 'Disetujui')
                                    <span class="badge bg-success"><i class="fas fa-check-circle"></i> {{ $log->status }}</span>
                                @else
                                    <span class="badge bg-danger"><i class="fas fa-times-circle"></i> {{ $log->status }}</span>
                                @endif
                            </td>
                            <td class="text-center">{{ $log->created_at->format('d M Y H:i:s') }}</td>
                            <td>
                                <form action="{{ route('verifikasi.verify', $log->id) }}" method="POST">
                                    @csrf
                                    <button name="status" value="Disetujui" class="btn btn-success">
                                        <i class="fas fa-check"></i> Setujui
                                    </button>
                                    <button name="status" value="Ditolak" class="btn btn-danger mt-1">
                                        <i class="fas fa-times"></i> Tolak
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
