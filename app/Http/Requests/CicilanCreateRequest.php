<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CicilanCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'penjualan_id' => ['required', 'integer', 'exists:penjualans,id'],
            'jumlah_per_cicilan' => ['required', 'integer'],
            'total_cicilan' => ['required', 'integer'],
            'sisa_cicilan' => ['required', 'integer'],
            'status' => ['nullable', 'string', 'in:Lunas,Belum Lunas'],
            'date' => ['required', 'date'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'statusCode' => 400,
            'success' => false,
            'errors' => [
                'message' => [
                    $validator->getMessageBag()
                ]
            ]
        ], 400));
    }
}
