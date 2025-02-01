<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PembayaranCicilanCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'statusCode' => 200,
            'success' => true,
            'message' => 'Get pembayaran cicilans success',
            'data' => [
                'data' => PembayaranCicilanResource::collection($this->collection)
            ]
        ];
    }
}
