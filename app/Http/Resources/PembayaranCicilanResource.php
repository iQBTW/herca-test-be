<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PembayaranCicilanResource extends JsonResource
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
            'jumlah_pembayaran' => $this->jumlah_pembayaran,
            'date' => $this->date,
            'cicilan' => new CicilanResource($this->cicilan),
        ];
    }
}
