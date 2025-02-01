<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MarketingCollection;
use App\Models\Marketing;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class MarketingController extends Controller
{
    public function getAllMarketing()
    {
        $marketings = Marketing::get();

        if ($marketings->isEmpty()) {
            throw new HttpResponseException(response()->json([
                'statusCode' => 404,
                'success' => false,
                'errors' => [
                    'message' => [
                        'No marketings found'
                    ]
                ]
            ], 404));
        }

        return new MarketingCollection($marketings);
    }
}
