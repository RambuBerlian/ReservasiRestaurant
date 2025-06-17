<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DetailReservasi;  // <-- pastikan ini ada
use Illuminate\Http\Request;

class DetailReservasiController extends Controller
{
    public function index()
    {
        return response()->json(DetailReservasi::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_waktu' => 'required|date',
            'lokasi' => 'required|string',
            'jenis_layanan' => 'required|string',
        ]);

        $reservasi = DetailReservasi::create($validated);

        return response()->json([
            'message' => 'Detail reservasi berhasil ditambahkan.',
            'data' => $reservasi
        ], 201);
    }

    public function show($id)
    {
        $reservasi = DetailReservasi::find($id);

        if (!$reservasi) {
            return response()->json(['message' => 'Detail reservasi tidak ditemukan.'], 404);
        }

        return response()->json($reservasi, 200);
    }

    public function update(Request $request, $id)
    {
        $reservasi = DetailReservasi::find($id);

        if (!$reservasi) {
            return response()->json(['message' => 'Detail reservasi tidak ditemukan.'], 404);
        }

        $validated = $request->validate([
            'tanggal_waktu' => 'required|date',
            'lokasi' => 'required|string',
            'jenis_layanan' => 'required|string',
        ]);

        $reservasi->update($validated);

        return response()->json([
            'message' => 'Detail reservasi berhasil diperbarui.',
            'data' => $reservasi
        ], 200);
    }

    public function destroy($id)
    {
        $reservasi = DetailReservasi::find($id);

        if (!$reservasi) {
            return response()->json(['message' => 'Detail reservasi tidak ditemukan.'], 404);
        }

        $reservasi->delete();

        return response()->json(['message' => 'Detail reservasi berhasil dihapus.'], 200);
    }
}
