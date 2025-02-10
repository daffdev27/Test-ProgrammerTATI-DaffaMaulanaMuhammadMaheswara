<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Predikat Kinerja Pegawai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8d7da;
            text-align: center;
            padding: 20px;
        }
        .container {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(255, 0, 0, 0.3);
            display: inline-block;
            width: 50%;
            border: 2px solid #dc3545;
        }
        select, button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border-radius: 5px;
            border: 1px solid #dc3545;
            font-size: 16px;
        }
        select {
            background-color: #f8d7da;
            color: #721c24;
        }
        button {
            background-color: #dc3545;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            background-color: #c82333;
        }
        h2 {
            color: #721c24;
        }
        h3 {
            color: #721c24;
            background-color: #f5c6cb;
            padding: 10px;
            border-radius: 5px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Predikat Kinerja Pegawai</h2>
        <form method="post">
            <label for="hasil_kerja">Hasil Kerja:</label>
            <select name="hasil_kerja" id="hasil_kerja">
                <option value="dibawah ekspektasi">Dibawah Ekspektasi</option>
                <option value="sesuai ekspektasi">Sesuai Ekspektasi</option>
                <option value="diatas ekspektasi">Diatas Ekspektasi</option>
            </select>
            
            <label for="perilaku">Perilaku:</label>
            <select name="perilaku" id="perilaku">
                <option value="dibawah ekspektasi">Dibawah Ekspektasi</option>
                <option value="sesuai ekspektasi">Sesuai Ekspektasi</option>
                <option value="diatas ekspektasi">Diatas Ekspektasi</option>
            </select>
            
            <button type="submit">Cek Predikat</button>
        </form>
        
        <?php
        function predikat_kinerja($hasil_kerja, $perilaku) {
            $matrix = [
                'dibawah ekspektasi' => [
                    'dibawah ekspektasi' => 'Sangat Kurang',
                    'sesuai ekspektasi' => 'Butuh perbaikan',
                    'diatas ekspektasi' => 'Butuh perbaikan'
                ],
                'sesuai ekspektasi' => [
                    'dibawah ekspektasi' => 'Kurang/misconduct',
                    'sesuai ekspektasi' => 'Baik',
                    'diatas ekspektasi' => 'Baik'
                ],
                'diatas ekspektasi' => [
                    'dibawah ekspektasi' => 'Kurang/misconduct',
                    'sesuai ekspektasi' => 'Baik',
                    'diatas ekspektasi' => 'Sangat Baik'
                ]
            ];
        
            return $matrix[$hasil_kerja][$perilaku] ?? "Input tidak valid";
        }
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $hasil_kerja = $_POST["hasil_kerja"];
            $perilaku = $_POST["perilaku"];
            echo "<h3>Output Predikat Kinerja: <strong>" . predikat_kinerja($hasil_kerja, $perilaku) . "</strong></h3>";
        }
        ?>
    </div>
</body>
</html>
