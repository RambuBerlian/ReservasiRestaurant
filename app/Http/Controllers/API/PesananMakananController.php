<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PesananMakanan;
use Illuminate\Http\Request;

class PesananMakananController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/pesanan-makanan",
     *     summary="Tampilkan semua pesanan makanan",
     *     tags={"Pesanan Makanan"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="List pesanan makanan"
     *     )
     * )
     */
    public function index()
    {
        return response()->json(PesananMakanan::all(), 200);
    }

    /**
     * @OA\Post(
     *     path="/api/pesanan-makanan",
     *     summary="Tambah pesanan makanan",
     *     tags={"Pesanan Makanan"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"daftar_menu", "jumlah_menu"},
     *             @OA\Property(property="daftar_menu", type="string", example="Nasi Goreng"),
     *             @OA\Property(property="jumlah_menu", type="integer", example=2),
     *             @OA\Property(property="catatan_tambahan", type="string", example="Tanpa pedas")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Pesanan berhasil ditambahkan"
     *     )
     * )
     */
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

    /**
     * @OA\Get(
     *     path="/api/pesanan-makanan/{id}",
     *     summary="Tampilkan detail pesanan",
     *     tags={"Pesanan Makanan"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID pesanan",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detail pesanan"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Pesanan tidak ditemukan"
     *     )
     * )
     */
    public function show($id)
    {
        $pesanan = PesananMakanan::find($id);

        if (!$pesanan) {
            return response()->json(['message' => 'Pesanan tidak ditemukan.'], 404);
        }

        return response()->json($pesanan, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/pesanan-makanan/{id}",
     *     summary="Update pesanan makanan",
     *     tags={"Pesanan Makanan"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID pesanan",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"daftar_menu", "jumlah_menu"},
     *             @OA\Property(property="daftar_menu", type="string", example="Ayam Bakar"),
     *             @OA\Property(property="jumlah_menu", type="integer", example=3),
     *             @OA\Property(property="catatan_tambahan", type="string", example="Tambah sambal")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Pesanan berhasil diperbarui"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Pesanan tidak ditemukan"
     *     )
     * )
     */
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

    /**
     * @OA\Delete(
     *     path="/api/pesanan-makanan/{id}",
     *     summary="Hapus pesanan makanan",
     *     tags={"Pesanan Makanan"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID pesanan",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Pesanan berhasil dihapus"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Pesanan tidak ditemukan"
     *     )
     * )
     */
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
