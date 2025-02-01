<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CicilanCollection extends ResourceCollection
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
            'message' => 'Get cicilans success',
            'data' => [
                'data' => CicilanResource::collection($this->collection)
            ]
        ];
    }
}
