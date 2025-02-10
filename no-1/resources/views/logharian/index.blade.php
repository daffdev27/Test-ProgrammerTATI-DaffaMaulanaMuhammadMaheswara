<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Harian</title>
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
        .btn-primary {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-primary:hover {
            background-color: #b02a37;
        }
        .table thead {
            background-color: #dc3545;
            color: white;
        }
        .badge-warning {
            background-color: #ffc107;
            color: black;
        }
        .badge-success {
            background-color: #28a745;
        }
        .badge-danger {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center fw-bold text-danger"><i class="fas fa-book"></i> Log Harian</h2>
        <p class="text-center text-muted">Anda masuk sebagai <strong>{{ ucfirst(str_replace('_', ' ', session('role'))) }}</strong></p>

        <div class="card shadow-sm mt-3">
            <div class="card-header">
                <i class="fas fa-plus-circle"></i> Tambah Log Harian
            </div>
            <div class="card-body">
                <form action="{{ route('logharian.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-bold"><i class="fas fa-pencil-alt"></i> Deskripsi Log</label>
                        <textarea name="deskripsi" class="form-control" rows="3" placeholder="Tulis aktivitas hari ini..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save"></i> Simpan Log
                    </button>
                </form>
            </div>
        </div>

        <div class="table-responsive mt-4">
            <table class="table table-striped table-bordered align-middle shadow-sm">
                <thead class="table-danger">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Pegawai</th>
                        <th>Bidang</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Dibuat Pada</th>
                        <th>Terverifikasi Pada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $index => $log)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td><i class="fas fa-user"></i> {{ $log->pegawai->nama }}</td>
                            <td class="text-center">
                                @if(in_array($log->pegawai->role, ['kepala_bidang_1', 'staff_1']))
                                    <span class="badge bg-primary">Bidang 1</span>
                                @elseif(in_array($log->pegawai->role, ['kepala_bidang_2', 'staff_2']))
                                    <span class="badge bg-success">Bidang 2</span>
                                @else
                                    <span class="badge bg-secondary">Tidak Ada Bidang</span>
                                @endif
                            </td>
                            <td class="text-truncate text-wrap" style="max-width: 400px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $log->deskripsi }}">
                                {{ $log->deskripsi }}
                            </td>
                            <td class="text-center">
                                @if($log->status == 'Pending')
                                    <span class="badge bg-warning"><i class="fas fa-clock"></i> {{ $log->status }}</span>
                                @elseif($log->status == 'Disetujui')
                                    <span class="badge bg-success"><i class="fas fa-check-circle"></i> {{ $log->status }}</span>
                                @else
                                    <span class="badge bg-danger"><i class="fas fa-times-circle"></i> {{ $log->status }}</span>
                                @endif
                            </td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($log->created_at)->format('d M Y H:i:s') }}</td>
                            <td class="text-center">
                                @if($log->verified_at)
                                    {{ \Carbon\Carbon::parse($log->verified_at)->format('d M Y H:i:s') }}
                                @else
                                    <span class="text-muted">Belum Diverifikasi</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($log->status == 'Pending' && $log->pegawai->id == session('pegawai_id'))
                                    <div class="d-flex flex-column align-items-center w-100">
                                        <form action="{{ route('logharian.update', $log->id) }}" method="POST" class="w-100">
                                            @csrf
                                            <input type="text" name="deskripsi" value="{{ $log->deskripsi }}" 
                                                class="form-control form-control-sm text-center mb-2 w-100" 
                                                style="border-radius: 5px;" required>
                                            
                                            <div class="d-flex gap-2 w-100">
                                                <button type="submit" class="btn btn-warning btn-sm w-50" style="border-radius: 5px;">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <form action="{{ route('logharian.destroy', $log->id) }}" method="POST" class="w-50">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm w-50" style="border-radius: 5px;">
                                                        <i class="fas fa-trash-alt"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-muted">Tidak dapat diedit</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
