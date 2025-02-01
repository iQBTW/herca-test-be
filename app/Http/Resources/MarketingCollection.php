<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MarketingCollection extends ResourceCollection
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
            'message' => 'Get marketings success',
            'data' => [
                'data' => MarketingResource::collection($this->collection)
            ]
        ];
    }
}
