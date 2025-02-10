<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Provinsi;

class ProvinsiController extends Controller
{
    public function index()
    {
        $provinsi = Provinsi::all();

        if ($provinsi->isEmpty()) {
            $response = Http::get('https://wilayah.id/api/provinces.json');

            if ($response->failed()) {
                return response()->json(['message' => 'Gagal mengambil data provinsi'], 500);
            }

            return response()->json($response->json(), 200);
        }

        return response()->json($provinsi, 200);
    }
    public function show($id)
    {
        $provinsi = Provinsi::find($id);
        
        if (!$provinsi) {
            $response = Http::get("https://wilayah.id/api/provinces.json");
            $data = $response->json();
    
            foreach ($data['data'] as $prov) {
                if ($prov['code'] == $id) {
                    return response()->json($prov, 200);
                }
            }
    
            return response()->json(['message' => 'Provinsi tidak ditemukan'], 404);
        }
    
        return response()->json($provinsi, 200);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:provinsis',
            'name' => 'required'
        ]);

        $provinsi = Provinsi::create($request->all());
        return response()->json($provinsi, 201);
    }

    public function update(Request $request, $id)
    {
        $provinsi = Provinsi::find($id);
        if (!$provinsi) {
            return response()->json(['message' => 'Provinsi tidak ditemukan'], 404);
        }

        $request->validate([
            'code' => 'sometimes|unique:provinsis,code,' . $id,
            'name' => 'sometimes'
        ]);

        $provinsi->update($request->all());
        return response()->json($provinsi, 200);
    }

    public function destroy($id)
    {
        $provinsi = Provinsi::find($id);
        if (!$provinsi) {
            return response()->json(['message' => 'Provinsi tidak ditemukan'], 404);
        }

        $provinsi->delete();
        return response()->json(['message' => 'Provinsi berhasil dihapus'], 200);
    }
}
