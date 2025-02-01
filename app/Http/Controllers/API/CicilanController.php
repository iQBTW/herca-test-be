<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CicilanCreateRequest;
use App\Http\Resources\CicilanCollection;
use App\Models\Cicilan;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class CicilanController extends Controller
{
    public function getAllCicilan()
    {
        $cicilans = Cicilan::with('penjualan')->get();

        if ($cicilans->isEmpty()) {
            throw new HttpResponseException(response()->json([
                'statusCode' => 404,
                'success' => false,
                'errors' => [
                    'message' => [
                        'No cicilans found'
                    ]
                ]
            ], 404));
        }

        return new CicilanCollection($cicilans);
    }

    public function store(CicilanCreateRequest $request)
    {
        $data = $request->validated();

        try {
            $cicilan = new Cicilan($data);
            $cicilan->save();

            return response()->json([
                'statusCode' => 201,
                'success' => true,
                'message' => 'Cicilan created successfully',
                'data' => $cicilan
            ], 201);

        } catch (Exception $e) {
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
