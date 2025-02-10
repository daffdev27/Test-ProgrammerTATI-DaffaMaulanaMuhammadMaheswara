<?php

namespace App\Http\Controllers;

use App\Models\LogHarian;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class LogHarianController extends Controller
{
    public function index()
    {
        $logs = LogHarian::with('pegawai')->get();
        return view('logharian.index', compact('logs'));
    }

    public function store(Request $request)
    {
        $pegawai = Pegawai::where('role', session('role'))->first();

        if (!$pegawai) {
            return redirect()->route('logharian.index')->with('error', 'Pegawai tidak ditemukan.');
        }

        LogHarian::create([
            'pegawai_id' => $pegawai->id,
            'deskripsi' => $request->deskripsi,
            'status' => 'Pending',
        ]);

        return redirect()->route('logharian.index')->with('success', 'Log Harian berhasil ditambahkan!');
    }
}
