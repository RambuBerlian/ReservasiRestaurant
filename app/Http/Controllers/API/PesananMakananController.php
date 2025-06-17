<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PesananMakanan;
use Illuminate\Http\Request;

class PesananMakananController extends Controller
{
    public function index()
    {
        return response()->json(PesananMakanan::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'daftar_menu' => 'required',
            'jumlah_menu' => 'required|integer',
            'catatan_tambahan' => 'nullable',
        ]);

        $pesanan = PesananMakanan::create($validated);

        return response()->json([
            'message' => 'Pesanan berhasil ditambahkan.',
            'data' => $pesanan
        ], 201);
    }

    public function show($id)
    {
        $pesanan = PesananMakanan::find($id);

        if (!$pesanan) {
            return response()->json(['message' => 'Pesanan tidak ditemukan.'], 404);
        }

        return response()->json($pesanan, 200);
    }

    public function update(Request $request, $id)
    {
        $pesanan = PesananMakanan::find($id);

        if (!$pesanan) {
            return response()->json(['message' => 'Pesanan tidak ditemukan.'], 404);
        }

        $validated = $request->validate([
            'daftar_menu' => 'required',
            'jumlah_menu' => 'required|integer',
            'catatan_tambahan' => 'nullable',
        ]);

        $pesanan->update($validated);

        return response()->json([
            'message' => 'Pesanan berhasil diperbarui.',
            'data' => $pesanan
        ], 200);
    }

    public function destroy($id)
    {
        $pesanan = PesananMakanan::find($id);

        if (!$pesanan) {
            return response()->json(['message' => 'Pesanan tidak ditemukan.'], 404);
        }

        $pesanan->delete();

        return response()->json(['message' => 'Pesanan berhasil dihapus.'], 200);
    }
}
