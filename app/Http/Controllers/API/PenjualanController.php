<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PenjualanCollection;
use App\Models\Penjualan;
use DB;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function getAllPenjualan()
    {
        $penjualans = Penjualan::with('marketing')->get();

        if ($penjualans->isEmpty()) {
            throw new HttpResponseException(response()->json([
                'statusCode' => 404,
                'success' => false,
                'errors' => [
                    'message' => [
                        'No penjualans found'
                    ]
                ]
            ], 404));
        }

        return new PenjualanCollection($penjualans);
    }

    public function getPenjualanKomisi()
    {
        $penjualanByCommissions = DB::table('penjualans')
            ->join('marketings', 'penjualans.marketing_id', '=', 'marketings.id')
            ->select(
                'marketings.name',
                DB::raw('MONTHNAME(penjualans.date) as bulan'),
                DB::raw('SUM(penjualans.total_balance) as omzet'),
                DB::raw('CASE
                        WHEN SUM(penjualans.total_balance) <= 100000000 THEN 0
                        WHEN SUM(penjualans.total_balance) > 100000000 AND SUM(penjualans.total_balance) <= 200000000 THEN 2.5
                        WHEN SUM(penjualans.total_balance) > 200000000 AND SUM(penjualans.total_balance) <= 500000000 THEN 5
                        ELSE 10
                    END as komisi_persen'),
                DB::raw('CASE
                        WHEN SUM(penjualans.total_balance) <= 100000000 THEN 0
                        WHEN SUM(penjualans.total_balance) > 100000000 AND SUM(penjualans.total_balance) <= 200000000 THEN SUM(penjualans.total_balance) * 0.025
                        WHEN SUM(penjualans.total_balance) > 200000000 AND SUM(penjualans.total_balance) <= 500000000 THEN SUM(penjualans.total_balance) * 0.05
                        ELSE SUM(penjualans.total_balance) * 0.10
                    END as komisi_nominal')
            )
            ->groupBy('marketings.name', DB::raw('MONTH(penjualans.date)'), DB::raw('MONTHNAME(penjualans.date)'))
            ->orderByRaw('MONTH(penjualans.date), marketings.name')
            ->get();

        if ($penjualanByCommissions->isEmpty()) {
            throw new HttpResponseException(response()->json([
                'statusCode' => 404,
                'success' => false,
                'errors' => [
                    'message' => [
                        'No penjualans found'
                    ]
                ]
            ], 404));
        }

        foreach ($penjualanByCommissions as $penjualan) {
            number_format($penjualan->omzet, 0, ',', '.') . ' ' .
                $penjualan->komisi_persen . '% ' . number_format(intval($penjualan->komisi_nominal), 0, ',', '.');
        }

        return response()->json([
            'statusCode' => 200,
            'success' => true,
            'message' => 'Get penjualan komisi success',
            'data' => [
                'data' => $penjualanByCommissions
            ]
        ], 200);
    }
}
