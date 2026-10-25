<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LaporanApiController extends Controller
{
    public function destroy(Request $request, $id): JsonResponse
    {
        $laporan = $request->user()->laporan()->findOrFail($id);

        if ($laporan->foto) {
            @unlink(public_path('uploads/laporan/'.$laporan->foto));
        }
        $laporan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil dihapus.',
            'data'    => null,
        ]);
    }
}
