<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Edukasi;
use App\Models\EdukasiKlaim;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EdukasiApiController extends Controller
{
    public function klaim(Request $request, Edukasi $edukasi): JsonResponse
    {
        $user = $request->user();
        $sudahKlaim = false;

        DB::transaction(function () use ($user, $edukasi, &$sudahKlaim) {
            // createOrFirst memanfaatkan unique(user_id, edukasi_id): aman dari klik ganda
            $klaim = EdukasiKlaim::createOrFirst(
                ['user_id' => $user->id, 'edukasi_id' => $edukasi->id],
                ['poin_didapat' => $edukasi->poin],
            );

            if ($klaim->wasRecentlyCreated) {
                $user->increment('total_poin', $edukasi->poin);
            } else {
                $sudahKlaim = true;
            }
        });

        if ($sudahKlaim) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu sudah klaim poin untuk artikel ini.',
            ], 409);
        }

        return response()->json([
            'success' => true,
            'message' => "+{$edukasi->poin} poin berhasil diklaim!",
            'data'    => ['total_poin' => $user->fresh()->total_poin],
        ]);
    }
}
