<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DetailReservasi;  // <-- pastikan ini ada
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class DetailReservasiController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/detail-reservasi",
     *     summary="Tampilkan semua detail reservasi",
     *     tags={"Detail Reservasi"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil menampilkan semua data detail reservasi"
     *     )
     * )
     */
    public function index()
    {
        return response()->json(DetailReservasi::all(), 200);
    }

    /**
     * @OA\Post(
     *     path="/api/detail-reservasi",
     *     summary="Buat detail reservasi baru",
     *     tags={"Detail Reservasi"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"tanggal_waktu", "lokasi", "jenis_layanan"},
     *             @OA\Property(property="tanggal_waktu", type="string", format="date-time", example="2025-06-17 19:00:00"),
     *             @OA\Property(property="lokasi", type="string", example="Lantai 2, Meja 5"),
     *             @OA\Property(property="jenis_layanan", type="string", example="Dine In")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Berhasil membuat detail reservasi"
     *     )
     * )
     */
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

    /**
     * @OA\Get(
     *     path="/api/detail-reservasi/{id}",
     *     summary="Tampilkan detail reservasi berdasarkan ID",
     *     tags={"Detail Reservasi"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID dari detail reservasi"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detail reservasi ditemukan"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Detail reservasi tidak ditemukan"
     *     )
     * )
     */
    public function show($id)
    {
        $reservasi = DetailReservasi::find($id);

        if (!$reservasi) {
            return response()->json(['message' => 'Detail reservasi tidak ditemukan.'], 404);
        }

        return response()->json($reservasi, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/detail-reservasi/{id}",
     *     summary="Perbarui detail reservasi",
     *     tags={"Detail Reservasi"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID dari detail reservasi"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"tanggal_waktu", "lokasi", "jenis_layanan"},
     *             @OA\Property(property="tanggal_waktu", type="string", format="date-time", example="2025-06-17 20:00:00"),
     *             @OA\Property(property="lokasi", type="string", example="Lantai 1, Meja 8"),
     *             @OA\Property(property="jenis_layanan", type="string", example="Take Away")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil memperbarui detail reservasi"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Detail reservasi tidak ditemukan"
     *     )
     * )
     */
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

    /**
     * @OA\Delete(
     *     path="/api/detail-reservasi/{id}",
     *     summary="Hapus detail reservasi berdasarkan ID",
     *     tags={"Detail Reservasi"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID dari detail reservasi"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil menghapus detail reservasi"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Detail reservasi tidak ditemukan"
     *     )
     * )
     */
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
