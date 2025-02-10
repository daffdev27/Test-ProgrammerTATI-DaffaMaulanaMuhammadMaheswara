<?php

namespace App\Http\Controllers;

use App\Models\LogHarian;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    public function index()
    {
        $role = session('role');
        $pegawai = Pegawai::where('role', $role)->first();

        if (!$pegawai) {
            return redirect()->route('dashboard')->with('error', 'Pegawai tidak ditemukan.');
        }

        if ($role == 'kepala_dinas') {
            $logs = LogHarian::where('status', 'Pending')->with('pegawai')->get();
        } elseif ($role == 'kepala_bidang_1') {
            $logs = LogHarian::whereHas('pegawai', function ($query) {
                $query->where('role', 'staff_1');
            })->where('status', 'Pending')->get();
        } elseif ($role == 'kepala_bidang_2') {
            $logs = LogHarian::whereHas('pegawai', function ($query) {
                $query->where('role', 'staff_2');
            })->where('status', 'Pending')->get();
        } else {
            $logs = collect([]);
        }

        return view('verifikasi.index', compact('logs'));
    }

    public function verify(Request $request, LogHarian $logHarian)
    {
        $logHarian->update([
            'status' => $request->status,
            'verified_at' => now(),
        ]);
    
        return redirect()->route('verifikasi.index')->with('success', 'Log telah diverifikasi!');
    }
    
}

