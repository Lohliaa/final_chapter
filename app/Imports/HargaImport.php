<?php

namespace App\Imports;

use App\Models\Harga;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;
use Throwable;

class HargaImport implements ToModel, WithHeadingRow, WithValidation, WithChunkReading, ShouldQueue
{
    protected $errors = [];

    public function rules(): array
    {
        return [
            'price_per_pcs' => 'required|numeric',
        ];
    }

    public function model(array $row)
    {
        $userRole = Auth::id();

        return new Harga([
            "component_number_ori" => $row['component_number_ori'],
            "component_number" => $row['component_number'],
            "item" => $row['item'],
            "price_per_pcs" => $row['price_per_pcs'],
            "user_id" => $userRole,
        ]);

        // return null;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function onError(Throwable $e)
    {
        $this->errors[] = $e->getMessage();
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
    public function withValidation($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->any()) {
                $this->errors[] = $validator->errors()->all();
            }
        });
    }

}
