<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PembayaranCicilanCreateRequest;
use App\Http\Resources\PembayaranCicilanCollection;
use App\Models\Cicilan;
use App\Models\PembayaranCicilan;
use Exception;
use DB;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class PembayaranCicilanController extends Controller
{

    public function getAllPembayaranCicilan()
    {
        $pembayaranCicilans = PembayaranCicilan::get();

        if ($pembayaranCicilans->isEmpty()) {
            throw new HttpResponseException(response()->json([
                'statusCode' => 404,
                'success' => false,
                'errors' => [
                    'message' => [
                        'No pembayaran cicilans found'
                    ]
                ]
            ], 404));
        }
        ;

        return new PembayaranCicilanCollection($pembayaranCicilans);
    }

    public function store(PembayaranCicilanCreateRequest $request)
    {
        $data = $request->validated();
        $cicilan = Cicilan::find($data['cicilan_id']);

        DB::beginTransaction();

        try {

            if ($data['jumlah_pembayaran'] < $cicilan->jumlah_per_cicilan) {
                throw new Exception('Jumlah Pembayaran Tidak Sesuai Dengan Jumlah Cicilan Per Bulan!');
            }

            if ($cicilan->sisa_cicilan == 0) {
                throw new Exception('Cicilan Sudah Lunas!');

            }

            $pembayaranCicilan = new PembayaranCicilan($data);
            $pembayaranCicilan->save();

            $cicilan->decrement('sisa_cicilan', $pembayaranCicilan['jumlah_pembayaran']);

            if ($cicilan->sisa_cicilan == 0) {
                $cicilan->update([
                    'status' => 'lunas'
                ]);
            } else if ($cicilan->sisa_cicilan > 0) {
                $cicilan->update([
                    'status' => 'belum lunas'
                ]);
            }
            $cicilan->save();


            DB::commit();

            return response()->json([
                'statusCode' => 201,
                'success' => true,
                'message' => 'Pembayaran Cicilan created successfully',
                'data' => $pembayaranCicilan
            ], 201);

        } catch (Exception $e) {
            DB::rollback();

            return response()->json([
                'statusCode' => 500,
                'success' => false,
                'errors' => [
                    'message' => [
                        $e->getMessage()
                    ]
                ]
            ], 500);
        }
    }
}
