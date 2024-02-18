<?php

namespace App\Imports;

use App\Models\MasterPrice;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;
use Throwable;

class MasterPriceImport implements ToModel, WithHeadingRow, WithValidation, WithChunkReading, ShouldQueue
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

        return new MasterPrice([
            "part_number_ori_sto" => $row['part_number_ori_sto'],
            "part_number_mpl" => $row['part_number_mpl'],
            "buppin" => $row['buppin'],
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
