<?php

use App\Http\Controllers\LogHarianController;
use App\Http\Controllers\VerifikasiController;
use Illuminate\Http\Request;
use App\Models\Pegawai;

Route::get('/', function () {
    $roles = Pegawai::all();
    return view('role_selection', compact('roles'));
})->name('role.selection');

Route::post('/set-role', function (Request $request) {
    $pegawai = Pegawai::where('role', $request->role)->first();

    if ($pegawai) {
        $request->session()->put('role', $request->role);
        $request->session()->put('pegawai_id', $pegawai->id);
    }
    return redirect()->route('dashboard');
})->name('set.role');


Route::get('/dashboard', function (Request $request) {
    if (!$request->session()->has('role')) return redirect()->route('role.selection');
    return view('dashboard', ['role' => session('role')]);
})->name('dashboard');

Route::get('/logharian', [LogHarianController::class, 'index'])->name('logharian.index');
Route::post('/logharian/store', [LogHarianController::class, 'store'])->name('logharian.store');
Route::post('/logharian/update/{logHarian}', [LogHarianController::class, 'update'])->name('logharian.update');
Route::post('/logharian/delete/{logHarian}', [LogHarianController::class, 'destroy'])->name('logharian.destroy');

Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi.index');
Route::post('/verifikasi/{logHarian}', [VerifikasiController::class, 'verify'])->name('verifikasi.verify');

