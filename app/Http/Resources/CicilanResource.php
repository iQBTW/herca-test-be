<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CicilanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'jumlah_per_cicilan' => $this->jumlah_per_cicilan,
            'total_cicilan' => $this->total_cicilan,
            'sisa_cicilan' => $this->sisa_cicilan,
            'status' => $this->status,
            'date' => $this->date,
            'penjualan' => new PenjualanResource($this->penjualan),
        ];
    }
}
